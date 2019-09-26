package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class regInfo extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg_info);
    }
    public void atras(View v){
        Intent i=new Intent(this, regTipo.class);
        startActivity(i);
    }
    public void registra_3(View v){
        Intent i=new Intent(this, regNom.class);
        startActivity(i);
    }
}
