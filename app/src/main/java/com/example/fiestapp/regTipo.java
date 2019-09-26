package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class regTipo extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg_tipo);
    }
    public void atras(View v){
        Intent i=new Intent(this, Index.class);
        startActivity(i);
    }
    public void registra_2(View v){
        Intent i=new Intent(this, regInfo.class);
        startActivity(i);
    }
}
