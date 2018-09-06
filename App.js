import React from 'react';
import LoginScreen from './components/LoginScreen';
import SignupScreen from './components/SignupScreen';
import OtpScreen from './components/OtpScreen';
import HomeScreen from './components/HomeScreen.js';
import AuthLoadingScreen from './common/AuthLoadingScreen';
import ServiceDetailScreen from './components/ServiceDetailScreen';
import Logout from './components/Logout';
import Footer from './common/Footer';
import { createSwitchNavigator, createStackNavigator } from 'react-navigation';

// Implementation of HomeScreen, OtherScreen, SignInScreen, AuthLoadingScreen
// goes here.

const AppStack = createStackNavigator({ Footer:Footer,Home:HomeScreen,Logout:Logout,Login: LoginScreen,Service:ServiceDetailScreen},{
  headerMode: 'none',
});
const AuthStack = createStackNavigator({ Signup: SignupScreen ,Otp:OtpScreen},{
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
