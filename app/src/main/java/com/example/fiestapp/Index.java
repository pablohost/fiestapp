package com.example.fiestapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class Index extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_index);
    }
    public void login(View v){
        Intent i=new Intent(this, Login.class);
        startActivity(i);
    }
    public void registro(View v){
        Intent i=new Intent(this, regTipo.class);
        startActivity(i);
    }
}
