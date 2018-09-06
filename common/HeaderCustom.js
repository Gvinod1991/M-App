import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
import { Header} from 'react-native-elements';
import LogoComponent from './LogoComponent';
const HeaderCustom = () => (
    <Header  outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFEB3B'}}  centerComponent={<LogoComponent />} 
    />
  );
export default HeaderCustom;