import React from 'react';
import {
  AsyncStorage,
} from 'react-native';
import Loader from '../common/Loader';

export default class AuthLoadingScreen extends React.Component {
  constructor(props) {
    super(props);
    this.state={
      loading:true
    }
    this._bootstrapAsync();
  }
  // Fetch the token from storage then navigate to our appropriate place
  _bootstrapAsync = async () => {
    const userToken = await AsyncStorage.getItem('userToken');
    //const userToken="ssss";
    // This will switch to the App screen or Auth screen and this loading
    // screen will be unmounted and thrown away.
    this.setState({loading:false});
    this.props.navigation.navigate(userToken ? 'App' : 'Auth');
    //this.props.navigation.navigate('Auth');
  };

  // Render any loading content that you like here
  render() {
    return (
     <Loader loading={this.state.loading} />
    );
  }
}
