import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
const LogoComponent = () => (
    <View>
        <Image style={{width:50,height:50}}
          source={require('../images/logo_50.png')}
        />
    </View>
  );
export default LogoComponent;

