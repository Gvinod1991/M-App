import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { createBottomTabNavigator , createStackNavigator } from 'react-navigation';
import { Icon } from 'react-native-elements';

import HomeScreen from './HomeScreen';
import OtpScreen from './OtpScreen';
import SetPassCodeScreen from './SetPassCodeScreen';
import LoginScreen from './LoginScreen';

const Footer = createBottomTabNavigator(
  {
    Home: {
      screen: HomeScreen,
      path: '/buttons',
      navigationOptions: {
        tabBarLabel: 'Home',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon
            name={focused ? 'home' : 'home'}
            size={30}
            type="material-community"
            color={tintColor}
          />
        ),
      },
    },
    Offers: {
      screen: OtpScreen,
      path: '/lists',
      navigationOptions: {
        tabBarLabel: 'Offers',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon name="tags" size={30} type="font-awesome" color={tintColor} />
        ),
      },
    },
    Profile: {
      screen:SetPassCodeScreen,
      path: '/input',
      navigationOptions: {
        tabBarLabel: 'Profile',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon
            name="user-circle"
            size={30}
            type="font-awesome"
            color={tintColor}
          />
        ),
      },
    },
    LogoutTab: {
      screen: LoginScreen,
      path: '/fonts',
      navigationOptions: {
        tabBarLabel: 'Logout',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon
            name={focused ? 'sign-out' : 'sign-out'}
            size={30}
            type="font-awesome"
            color={tintColor}
          />
        ),
      },
    },
  },
  {
    initialRouteName: 'Home',
    animationEnabled: false,
    swipeEnabled: true,
    // Android's default option displays tabBars on top, but iOS is bottom
    tabBarPosition: 'bottom',
    tabBarOptions: {
      activeTintColor: '#e91e63',
      // Android's default showing of icons is false whereas iOS is true
      showIcon: true,
    },
  }
);

export default Footer;