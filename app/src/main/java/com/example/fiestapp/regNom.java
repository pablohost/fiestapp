package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class regNom extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg_nom);
    }
    public void atras(View v){
        Intent i=new Intent(this, regInfo.class);
        startActivity(i);
    }
    public void registra_4(View v){
        Intent i=new Intent(this, regUsu.class);
        startActivity(i);
    }
}
