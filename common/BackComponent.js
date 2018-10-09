import React from 'react';
import {Text, View,TouchableHighlight} from 'react-native';
import { Icon} from 'react-native-elements';
export default class BackComponent extends React.Component{ 
    constructor(props){
        super(props);
    }
    render(){
        return(
            <TouchableHighlight  onPress={()=>this.props.navigation.goBack()}><View><Icon size={32} name="arrow-left" type="font-awesome" color='#FF3B70' /></View></TouchableHighlight>
        );
    }
}