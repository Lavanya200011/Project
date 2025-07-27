package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    private Button nextActivityButton;
    private Button openNextActivity2Button; // Declare the new button

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialize the button to go to the next activity
        nextActivityButton = findViewById(R.id.gotoinfo);

        // Initialize the button to go to NextActivity2
        openNextActivity2Button = findViewById(R.id.waactivity);

        // Set a click listener for the next activity button
        nextActivityButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Open the NextActivity
                Intent intent = new Intent(MainActivity.this, NextActivity.class);
                startActivity(intent);
            }
        });

        // Set a click listener for the NextActivity2 button
        openNextActivity2Button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Open the NextActivity2
                Intent intent = new Intent(MainActivity.this, NextActivity2.class);
                startActivity(intent);
            }
        });
    }
}
