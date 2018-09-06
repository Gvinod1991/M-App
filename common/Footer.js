import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { createBottomTabNavigator , createStackNavigator } from 'react-navigation';
import { Icon } from 'react-native-elements';

import HomeScreen from '../components/HomeScreen';
import OffersScreen from '../components/OffersScreen';
import ProfileScreen from '../components/ProfileScreen';
import BookingsScreen from '../components/BookingsScreen';

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
      screen: OffersScreen,
      path: '/lists',
      navigationOptions: {
        tabBarLabel: 'Offers',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon name="tags" size={30} type="font-awesome" color={tintColor} />
        ),
      },
    },
    BookingsTab: {
      screen: BookingsScreen,
      path: '/bookings',
      navigationOptions: {
        tabBarLabel: 'Bookings',
        tabBarIcon: ({ tintColor, focused }) => (
          <Icon
            name={focused ? 'calendar-check-o' : 'calendar-check-o'}
            size={30}
            type="font-awesome"
            color={tintColor}
          />
        ),
      },
    },
    Profile: {
      screen:ProfileScreen,
      path: '/profile',
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
  },
  {
    initialRouteName: 'Home',
    animationEnabled: false,
    swipeEnabled: true,
    // Android's default option displays tabBars on top, but iOS is bottom
    tabBarPosition: 'bottom',
    tabBarOptions: {
      activeTintColor: '#FFEB3B',
      // Android's default showing of icons is false whereas iOS is true
      showIcon: true,
    },
  }
);

export default Footer;