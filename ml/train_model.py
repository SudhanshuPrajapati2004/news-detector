#!/usr/bin/env python3          (use this if linux)

# Algorithm used to train our model "train_model.py"  – Passive-Aggressive .
# run this in your terminal "  pip instal pandas scikit-learn "

import os
import sys
import argparse
import pickle
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import PassiveAggressiveClassifier
from sklearn.metrics import accuracy_score, confusion_matrix, classification_report
import csv  

# 1. responsible for accept  inputs

this_dir = os.path.dirname(os.path.abspath(__file__))

parser = argparse.ArgumentParser(description="Train a fake-news detection model.")
parser.add_argument(
    "--csv",
    default=os.path.join(this_dir, "training_data.csv"),
    help="Path to the labelled CSV file (default: training_data.csv next to this script)",
)
parser.add_argument(
    "--out-model",
    default=os.path.join(this_dir, "model.pkl"),
    help="Where to save the trained model (default: model.pkl next to this script)",
)
parser.add_argument(
    "--out-vec",
    default=os.path.join(this_dir, "vectorizer.pkl"),
    help="Where to save the fitted TF-IDF vectorizer (default: vectorizer.pkl next to this script)",
)
args = parser.parse_args()

# 2. Load the data / checking / preparaion for training

csv_path = args.csv
if not os.path.exists(csv_path):
    sys.exit(f"[ERROR] Dataset not found: {csv_path}")

print(f"Loading dataset: {csv_path}")
df = pd.read_csv(csv_path, encoding="utf-8", quoting=csv.QUOTE_ALL)

# Confirm all required columns are present
required = {"headline", "body_text", "label"}
missing = required.difference(df.columns)
if missing:
    sys.exit(f"[ERROR] CSV is missing these columns: {', '.join(missing)}")


# Fill any NaNs and build a single text feature
df["headline"].fillna("", inplace=True)
df["body_text"].fillna("", inplace=True)
df["full_text"] = (df["headline"] + " " + df["body_text"]).str.lower()




X = df["full_text"]
y = df["label"].astype(int)   # ensure numeric

# 3. splitting our data  for training and testing
print("Splitting train/test...")
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.20, random_state=42, stratify=y
)

# 4. Vectorise
print("Vectorising with TF-IDF...")
vectorizer = TfidfVectorizer(stop_words="english", max_df=0.7)
X_train_vec = vectorizer.fit_transform(X_train)
X_test_vec = vectorizer.transform(X_test)

# 5. Train the model
print("Training Passive-Aggressive classifier...")
pac = PassiveAggressiveClassifier(max_iter=50)
pac.fit(X_train_vec, y_train)

# 6. Evaluate
print("\nEvaluation on held-out test set:")
y_pred = pac.predict(X_test_vec)
print(f"Accuracy: {accuracy_score(y_test, y_pred) * 100:.2f}%\n")
print("Confusion matrix:")
print(confusion_matrix(y_test, y_pred))
print("\nClassification report:")
print(classification_report(y_test, y_pred, target_names=["Real", "Fake"]))

# 7. Classification Report
with open(args.out_model, "wb") as f:
    pickle.dump(pac, f)
with open(args.out_vec, "wb") as f:
    pickle.dump(vectorizer, f)

print(f"\nModel saved to      : {args.out_model}")
print(f"Vectorizer saved to : {args.out_vec}")
print("Training complete ✅")
