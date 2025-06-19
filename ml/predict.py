#!/usr/bin/env python3       (if linux)

import sys
import os
import joblib              # loads model.pkl and vectorizer.pkl
import pandas as pd
import warnings

warnings.filterwarnings("ignore", category=UserWarning)

# 1. collect arguments

args = sys.argv[1:]
if len(args) != 4:
    print("Error: Expected 4 inputs: headline, body_text, author, source")
    sys.exit(1)

headline, body_text, author, source = args

# 2. full_text feature (same as in training)

full_text = f"{headline} {body_text}"
sample_df = pd.DataFrame({"full_text": [full_text]})

full_text = full_text.lower()


# 3. Load vectoriser and model 

base_dir = os.path.dirname(os.path.abspath(__file__))
vec_path = os.path.join(base_dir, "vectorizer.pkl")
model_path = os.path.join(base_dir, "model.pkl")

if not (os.path.exists(vec_path) and os.path.exists(model_path)):
    print("Error: vectorizer.pkl or model.pkl not found.")
    sys.exit(1)

vectoriser = joblib.load(vec_path)
model      = joblib.load(model_path)

# 4. Vectorise → Predict

X_vec = vectoriser.transform(sample_df["full_text"])
pred  = model.predict(X_vec)[0]     # 0 = Real, 1 = Fake

# 5. Return the label for PHP

print(int(pred))
