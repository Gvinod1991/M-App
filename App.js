import React from 'react';
import SignupScreen from './components/SignupScreen';
import OtpScreen from './components/OtpScreen';
import AuthLoadingScreen from './common/AuthLoadingScreen';
import SideMenu from './common/SideMenu';
import HomeScreen from './components/HomeScreen';
import ServiceDetailScreen from './components/ServiceDetailScreen';
import { createSwitchNavigator, createStackNavigator } from 'react-navigation';

// Implementation of HomeScreen, OtherScreen, SignInScreen, AuthLoadingScreen
// goes here.

const AppStack = createStackNavigator({ SideMenu:SideMenu,Home:HomeScreen,Service:ServiceDetailScreen},{
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
