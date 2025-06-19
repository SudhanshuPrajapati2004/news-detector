#!/usr/bin/env python3

import os
import sys
import csv
import argparse
import joblib
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import PassiveAggressiveClassifier
from sklearn.metrics import accuracy_score
from sklearn.model_selection import train_test_split
import warnings

warnings.filterwarnings("ignore", category=UserWarning)

# 1. Command-line arguments

this_dir = os.path.dirname(os.path.abspath(__file__))

ap = argparse.ArgumentParser(description="Retrain the fake-news detector.")
ap.add_argument("--csv", default=os.path.join(this_dir, "training_data.csv"),
                help="Path to labelled dataset (default: training_data.csv next to this script)")
ap.add_argument("--out-model", default=os.path.join(this_dir, "model.pkl"),
                help="Filename for the refreshed model (default: model.pkl)")
ap.add_argument("--out-vec", default=os.path.join(this_dir, "vectorizer.pkl"),
                help="Filename for the refreshed TF-IDF vectoriser (default: vectorizer.pkl)")
ap.add_argument("--test-size", type=float, default=0.2,
                help="Hold-out fraction for quick sanity-check accuracy (default: 0.2)")
args = ap.parse_args()

# 2. Load & prepare data

if not os.path.exists(args.csv):
    sys.exit(f"[ERROR] Dataset not found: {args.csv}")

df = pd.read_csv(args.csv, quoting=csv.QUOTE_ALL, encoding="utf-8")
required_cols = {"headline", "body_text", "label"}
missing = required_cols.difference(df.columns)
if missing:
    sys.exit(f"[ERROR] CSV is missing columns: {', '.join(missing)}")

df["headline"].fillna("", inplace=True)
df["body_text"].fillna("", inplace=True)
df["full_text"] = (df["headline"] + " " + df["body_text"]).str.lower()

X = df["full_text"]
y = df["label"].astype(int)

# 3. Quick train/test split for a sanity-check metric

X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=args.test_size, random_state=42, stratify=y
)

# 4. Vectorise & train

vectoriser = TfidfVectorizer(stop_words="english", max_df=0.7)
X_train_vec = vectoriser.fit_transform(X_train)

model = PassiveAggressiveClassifier(max_iter=50)
model.fit(X_train_vec, y_train)

# 5. Evaluate 

accuracy = accuracy_score(y_test, model.predict(vectoriser.transform(X_test)))
print(f"✅ Retrain complete – hold-out accuracy: {accuracy*100:.2f}% on {len(y_test)} samples")

# 6. result
joblib.dump(model, args.out_model)
joblib.dump(vectoriser, args.out_vec)
print(f"Model saved to      : {args.out_model}")
print(f"Vectoriser saved to : {args.out_vec}")
