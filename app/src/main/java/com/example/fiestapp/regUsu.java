package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class regUsu extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg_usu);
    }
    public void atras(View v){
        Intent i=new Intent(this, regNom.class);
        startActivity(i);
    }
}
