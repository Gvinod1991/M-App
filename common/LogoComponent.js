import React from 'react';
import {Text, View,TextInputImage ,Image,ScrollView  } from 'react-native';
const LogoComponent = () => (
    <View>
        <Image style={{width:200,height:52}}
          source={require('../images/logo.png')}
        />
    </View>
  );
export default LogoComponent;

