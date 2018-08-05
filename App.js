import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import LoginScreen from './LoginScreen';
import OtpScreen from './OtpScreen';
import HomeScreen from './HomeScreen.js';
import AuthLoadingScreen from './AuthLoadingScreen';
import SetPassCodeScreen from './SetPassCodeScreen';
import Logout from './Logout';
import Footer from './Footer';
import { createSwitchNavigator, createStackNavigator } from 'react-navigation';

// Implementation of HomeScreen, OtherScreen, SignInScreen, AuthLoadingScreen
// goes here.

const AppStack = createStackNavigator({ Footer:Footer,Home:HomeScreen,Logout:Logout,Login: LoginScreen},{
  headerMode: 'none',
});
const AuthStack = createStackNavigator({ Login: LoginScreen ,Otp:OtpScreen,setPassCode:SetPassCodeScreen},{
  headerMode: 'none',
});

export default createSwitchNavigator (
  {
    AuthLoading: AuthLoadingScreen,
    App: AppStack,
    Auth: AuthStack,
  },
  {
    headerMode: 'none',
  },
  {
    initialRouteName: 'AuthLoading',
  }
  
);
