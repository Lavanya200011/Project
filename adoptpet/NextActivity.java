package com.example.myapplication;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class NextActivity extends AppCompatActivity {

    private TableLayout tableLayout;
    private EditText editTextName, editTextSavingAmount, editTextLoanGot, editTextDeleteName;
    private Button updateButton, deleteButton , openWhatsAppButton ;


    // Key for SharedPreferences
    private static final String PREF_TABLE_DATA = "table_data";

    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_next);

        // Initialize views
        tableLayout = findViewById(R.id.tableLayout);
        editTextName = findViewById(R.id.editText1);
        editTextSavingAmount = findViewById(R.id.editText2);
        editTextLoanGot = findViewById(R.id.editText3);
        editTextDeleteName = findViewById(R.id.editText8);
        updateButton = findViewById(R.id.button1);
        deleteButton = findViewById(R.id.button2);

        // Load saved data
        loadTableData();

        // Set click listener for the Update Info button
        updateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String name = editTextName.getText().toString().trim();
                String savingAmount = editTextSavingAmount.getText().toString().trim();
                String loanGot = editTextLoanGot.getText().toString().trim();
                String remainingDue = calculateRemainingDue(savingAmount, loanGot);

                if (name.isEmpty() || savingAmount.isEmpty() || loanGot.isEmpty()) {
                    Toast.makeText(NextActivity.this, "Please fill all fields", Toast.LENGTH_SHORT).show();
                } else {
                    updateTable(name, savingAmount, loanGot, remainingDue);
                }
            }
        });






        // Set click listener for the Delete Info button
    }

    // Method to calculate remaining due amount
    private String calculateRemainingDue(String savingAmount, String loanGot) {
        try {
            double savings = Double.parseDouble(savingAmount);
            double loan = Double.parseDouble(loanGot);
            return String.valueOf(Math.max(0, loan - savings));
        } catch (NumberFormatException e) {
            return "0";
        }
    }

    // Method to update the table
    private void updateTable(String name, String savingAmount, String loanGot, String remainingDue) {
        boolean rowUpdated = false;

        // Check if the name already exists in the table
        for (int i = 1; i < tableLayout.getChildCount(); i++) { // Skip header row
            TableRow row = (TableRow) tableLayout.getChildAt(i);
            TextView nameCell = (TextView) row.getChildAt(0);
            if (nameCell.getText().toString().equalsIgnoreCase(name)) {
                // Update existing row
                ((TextView) row.getChildAt(1)).setText(savingAmount);
                ((TextView) row.getChildAt(2)).setText(loanGot);
                ((TextView) row.getChildAt(3)).setText(remainingDue);
                rowUpdated = true;
                break;
            }
        }

        if (!rowUpdated) {
            // Add a new row if name does not exist
            TableRow newRow = new TableRow(this);
            newRow.addView(createTextView(name));
            newRow.addView(createTextView(savingAmount));
            newRow.addView(createTextView(loanGot));
            newRow.addView(createTextView(remainingDue));
            tableLayout.addView(newRow);
        }

        saveTableData(); // Save updated data
    }

    // Helper method to create TextView for a table cell
    private TextView createTextView(String text) {
        TextView textView = new TextView(this);
        textView.setText(text);
        textView.setPadding(8, 8, 8, 8);
        TableRow.LayoutParams params = new TableRow.LayoutParams(
                0, TableRow.LayoutParams.WRAP_CONTENT, 1.0f // Weight 1.0 for equal distribution
        );
        textView.setLayoutParams(params);
        return textView;
    }




    // Method to delete a row from the table
    private void deleteTableRow(String nameToDelete) {
        boolean rowDeleted = false;

        // Check if the name exists in the table
        for (int i = 1; i < tableLayout.getChildCount(); i++) { // Skip header row
            TableRow row = (TableRow) tableLayout.getChildAt(i);
            TextView nameCell = (TextView) row.getChildAt(0);
            if (nameCell.getText().toString().equalsIgnoreCase(nameToDelete)) {
                tableLayout.removeView(row);
                rowDeleted = true;
                break;
            }
        }

        if (rowDeleted) {
            Toast.makeText(this, "Information deleted successfully", Toast.LENGTH_SHORT).show();
            saveTableData(); // Save updated data
        } else {
            Toast.makeText(this, "Name not found", Toast.LENGTH_SHORT).show();
        }
    }

    // Method to save table data to SharedPreferences
    private void saveTableData() {
        JSONArray tableData = new JSONArray();

        // Iterate over table rows to collect data
        for (int i = 1; i < tableLayout.getChildCount(); i++) { // Skip header row
            TableRow row = (TableRow) tableLayout.getChildAt(i);
            JSONObject rowData = new JSONObject();
            try {
                rowData.put("name", ((TextView) row.getChildAt(0)).getText().toString());
                rowData.put("savingAmount", ((TextView) row.getChildAt(1)).getText().toString());
                rowData.put("loanGot", ((TextView) row.getChildAt(2)).getText().toString());
                rowData.put("remainingDue", ((TextView) row.getChildAt(3)).getText().toString());
                tableData.put(rowData);
            } catch (JSONException e) {
                e.printStackTrace();
                Log.e("saveTableData", "Error saving data", e);
            }
        }

        // Save JSON array to SharedPreferences
        getSharedPreferences(PREF_TABLE_DATA, MODE_PRIVATE)
                .edit()
                .putString(PREF_TABLE_DATA, tableData.toString())
                .apply();
    }

    // Method to load table data from SharedPreferences
    private void loadTableData() {
        String savedData = getSharedPreferences(PREF_TABLE_DATA, MODE_PRIVATE)
                .getString(PREF_TABLE_DATA, null);

        if (savedData != null) {
            try {
                JSONArray tableData = new JSONArray(savedData);
                for (int i = 0; i < tableData.length(); i++) {
                    JSONObject rowData = tableData.getJSONObject(i);
                    TableRow row = new TableRow(this);
                    row.addView(createTextView(rowData.getString("name")));
                    row.addView(createTextView(rowData.getString("savingAmount")));
                    row.addView(createTextView(rowData.getString("loanGot")));
                    row.addView(createTextView(rowData.getString("remainingDue")));
                    tableLayout.addView(row);
                }
            } catch (JSONException e) {
                Log.e("loadTableData", "Error loading data", e);
                e.printStackTrace();
            }
        }
    }
}
