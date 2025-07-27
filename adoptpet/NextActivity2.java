// MainActivity.java
package com.example.myapplication;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.myapplication.R;

public class NextActivity2 extends AppCompatActivity {

    private EditText memberCountInput, contributionInput, previousCollectionInput , givedloaninput;
    private TextView totalCollectionView, cumulativeCollectionView;
    private Button calculateButton, resetButton;

    private double cumulativeCollection = 0;

    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_next2);

        // Initialize UI components

        givedloaninput =findViewById(R.id.giveloaninput);
        contributionInput = findViewById(R.id.contributionInput);
        previousCollectionInput = findViewById(R.id.previousCollectionInput);
        totalCollectionView = findViewById(R.id.totalCollectionView);
        cumulativeCollectionView = findViewById(R.id.cumulativeCollectionView);
        calculateButton = findViewById(R.id.calculateButton);
        resetButton = findViewById(R.id.resetButton);

        // Calculate Button Listener
        calculateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                calculateCollections();
            }
        });

        // Reset Button Listener
        resetButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                resetFields();
            }
        });
    }

    private void calculateCollections() {
        try {
            int memberCount = 11;
            double contribution = Double.parseDouble(contributionInput.getText().toString());
            double previousCollection = Double.parseDouble(previousCollectionInput.getText().toString());

            // Calculate total and cumulative collections
            double totalCollection = memberCount * contribution;
            cumulativeCollection = previousCollection + totalCollection;

            // Display results
            totalCollectionView.setText(String.format("₹%.2f", totalCollection));
            cumulativeCollectionView.setText(String.format("₹%.2f", cumulativeCollection));

        } catch (NumberFormatException e) {
            Toast.makeText(this, "Please enter valid inputs.", Toast.LENGTH_SHORT).show();
        }
    }

    private void resetFields() {
        memberCountInput.setText("");
        contributionInput.setText("");
        previousCollectionInput.setText("");
        totalCollectionView.setText("₹0.00");
        cumulativeCollectionView.setText("₹0.00");
    }
}
