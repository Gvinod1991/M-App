import React from 'react';
import {Text,View,Image,StyleSheet,Dimensions} from 'react-native';
import { createDrawerNavigator,DrawerItems } from 'react-navigation';
import Footer from '../common/Footer';
import Terms from '../components/Terms';
import Support from '../components/Support';
//Side Menu Goes here
const CustomDrawerContentComponent = props => (
  <View style={{ flex: 1, backgroundColor: '#f4f5f8' }}>
      <View style={{ marginTop: 40, justifyContent: 'center', alignItems: 'center' }}>
      <Image
          source={require('../images/logo.png')}
          style={{ height:50,width: Dimensions.get('window').width * 0.57 }}
          resizeMode="contain"
      />
      </View>
      <View style={{ marginLeft: 10 }}>
      <DrawerItems {...props} />
      </View>
  </View>
); 
const SideMenu = createDrawerNavigator({
    Home: {
      screen:  Footer,
      navigationOptions: {
        drawerLabel: () => null
      }
    },
    Terms: {
      screen: Terms
    },
    Supprt: {
      screen: Support,
     
    },
    },
    {
        initialRouteName: 'Home',
        contentOptions: {
          activeTintColor: '#548ff7',
          activeBackgroundColor: 'transparent',
          inactiveTintColor: '#111',
          inactiveBackgroundColor: 'transparent',
          labelStyle: {
            fontSize: 15,
            marginLeft: 0,
          },
        },
        drawerPosition: "left",
        drawerWidth:  Dimensions.get('window').width * 0.7,
        contentComponent: CustomDrawerContentComponent,
        drawerOpenRoute: 'DrawerOpen',
        drawerCloseRoute: 'DrawerClose',
        drawerToggleRoute: 'DrawerToggle'
      }
);
export default SideMenu;