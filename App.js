import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import LoginScreen from './LoginScreen';
import OtpScreen from './OtpScreen';
import HomeScreen from './HomeScreen.js';
import AuthLoadingScreen from './AuthLoadingScreen'
import { createSwitchNavigator, createStackNavigator } from 'react-navigation';

// Implementation of HomeScreen, OtherScreen, SignInScreen, AuthLoadingScreen
// goes here.

const AppStack = createStackNavigator({ Home: HomeScreen });
const AuthStack = createStackNavigator({ Login: LoginScreen ,Otp:OtpScreen});

export default createSwitchNavigator (
  {
    AuthLoading: AuthLoadingScreen,
    App: AppStack,
    Auth: AuthStack,
  },
  {
    initialRouteName: 'AuthLoading',
  }
);
