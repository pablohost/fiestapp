package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class Login extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
    }
    public void registro(View v){
        Intent i=new Intent(this, regTipo.class);
        startActivity(i);
    }
    public void atras(View v){
        Intent i=new Intent(this, Index.class);
        startActivity(i);
    }
}
