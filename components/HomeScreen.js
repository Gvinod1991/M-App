import React from 'react';
import {TouchableHighlight,Text, View,Image,ScrollView,AsyncStorage,Platform,StyleSheet,Modal,Picker,Dimensions } from 'react-native';
import { Header,Card, Icon,SearchBar,Button,CheckBox,Slider} from 'react-native-elements';
import { Constants, Location, Permissions } from 'expo';
import LogoComponent from '../common/LogoComponent';
import Loader from '../common/Loader';
import config from '../config';
import LeftComponent from '../common/LeftComponent';
export default class HomeScreen extends React.Component {
  static navigationOptions = { header: null }
  constructor(props) {
    super(props);
    this.state={
        userToken:"",
        vendors:[],
        message:"",
        loading:true,
        location: null,
        errorMessage: null,
        isModalOpen:false,
        male:false,
        female:false,
        others:false,
        city_list:[{'city_name':'Choose City'}],
        area_list:[{'locality':'Choose Area'}],
        min_price:20,
        max_price:10000,
        value:500,
        gender:'NO',
        selected_area:'NO',
        filterColor:'#111'
        }
    this._retrieveuserToken();
    
  }
  componentWillMount() {
    if (Platform.OS === 'android' && !Constants.isDevice) {
      this.setState({
        errorMessage: 'Oops, this will not work on Sketch in an Android emulator. Try it on your device!',
      });
    } else {
      this._getLocationAsync();
    }
   
  }

  _getLocationAsync = async () => {
    let { status } = await Permissions.askAsync(Permissions.LOCATION);
    if (status !== 'granted') {
      this.setState({
        errorMessage: 'Permission to access location was denied',
      });
    }

    let location = await Location.getCurrentPositionAsync({});
    //this.getAreaName(location.coords.latitude,location.coords.longitude)
    //this.setState({ location });
  };
  /*getAreaName= (lat,lon)=>{
    fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + lat + ',' + lon + '&key=' + config.apiKey)
        .then((response) => response.json())
        .then((responseJson) => {
            var city_name = responseJson.results[0].address_components.filter(x => x.types.filter(t => t == 'administrative_area_level_2').length > 0)[0].short_name;
    })
  }*/
  //Open filters
  openFilters= () =>{
    this.setState({isModalOpen:true});
  }
  //Close filters
    //Open filters
  closeFilters= () =>{
    this.setState({isModalOpen:false});
  }
  //Apply filter option
  apply = () => {
    this.closeFilters();
    this.getVendors();
    this.setState({filterColor:'#FF3B70'});
    this.setState({apply:true});
  }
  //Apply filter option
  reset = () => {
    this.setState({apply:false});
    this.closeFilters();
    this.setState({selected_city:this.state.city_list[1].city_name});//City Bhubaneswar
    this.setState({selected_area:'NO'});
    this.setState({gender:'NO'},this.getVendors);//After sttate update callback to getVendor function
    this.setState({male:false});
    this.setState({female:false});
    this.setState({others:false});
    this.getPriceRange();
    //this.getVendors();
    this.setState({filterColor:'#111'})
  }
  //AsyncStorage.removeItem('userToken');
  _retrieveuserToken = async () => {
    try {
      const userToken = await AsyncStorage.getItem('userToken');
      if (userToken !== null) {
        // We have data!!
        this.getCityList();
        this.setState({ userToken: userToken});
        this.getPriceRange();
      }
      } catch (error) {
        // Error retrieving data
      }
  }
  //Function to get the list of vendors
  getVendors = () => {
    const url=config.apiEndpoint+'getListShop/'+this.state.selected_city+'/'+this.state.selected_area+'/'+this.state.gender+'/'+this.state.min_price+'/'+this.state.value;
    fetch(url, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
      }
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          this.setState({ vendors: responseJson.vendors});
          this.setState({renderedListData:responseJson.vendors});
          this.setState({noData:false});
        }
        else
        {
          this.setState({ vendors: []});
          this.setState({renderedListData:[]});
          this.setState({noData:true});
          this.setState({ message: "No results found in this location,Try with other location!"});
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Function to get the city list
  getCityList(){
    const url=config.apiEndpoint+'city-list';
    fetch(url, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
      }
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          let city_arr=this.state.city_list;
         responseJson.city_list.map((city) =>{
            city_arr.push({'city_name':city})
          });
          this.setState({ city_list : city_arr});
          this.setState({ selected_city: responseJson.city_list[0]});
          this.getVendors();
          this.getAreaList();
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Function to get area list
  getAreaList = () => {
    const url=config.apiEndpoint+'locallity-list/'+this.state.selected_city;
    fetch(url, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
      }
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          let area_arr=this.state.area_list;
          responseJson.localities.map((area) =>{
            area_arr.push({'locality':area.locality})
          });
          this.setState({ area_list : area_arr});
        }
        else
        {
          this.setState({ message: "No results found in this location,Try with other location!"});
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Function to get the minimum and maximum price range of the vendor
  getPriceRange = () => {
    const url=config.apiEndpoint+'price-range';
    fetch(url, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+this.state.userToken
      }
    }).then((response) => response.json())
      .then((responseJson) => {
        this.setState({loading:false});
        if(responseJson.status==1)
        {
          this.setState({'max_price':parseInt(responseJson.max)});
          this.setState({'min_price':parseInt(responseJson.min) > 0 ? parseInt(responseJson.min) : this.state.min_price});
          this.setState({'value':parseInt(responseJson.max)});
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Checkbox selection
  changeCheckBox = (type) => {
    this.setState({gender:type == 'Male' ? 'Male' : (type == 'Female' ? 'Female' : 'Both') });
    this.setState({male: type == 'Male' ? true : false});
    this.setState({female: type == 'Female' ? true : false});
    this.setState({others: type == 'Both' ? true : false});
  }
  //Search fucntion to search the vendor
  setSearchText(e){
    this.setState({loading:true});
    searchText = e.nativeEvent.text.toLowerCase();
    let fullList = this.state.vendors;
    let filteredList = fullList.filter((item) => { // search from a full list, and not from a previous search results list
      if(item.shop_name.toLowerCase().match(searchText))
        return item;
    })
    if (!searchText || searchText === '') {
      this.setState({
        loading:false,
        renderedListData: fullList,
        noData:false,
      })
    } else if (!filteredList.length) {
     // set no data flag to true so as to render flatlist conditionally
       this.setState({
        loading:false,
         noData: true
       })
    }
    else if (Array.isArray(filteredList)) {
      this.setState({
        loading:false,
        noData: false,
        renderedListData: filteredList
      })
    }
   }
   render() {
    console.disableYellowBox = true;
    const CloseComponent = () => (
      <TouchableHighlight  onPress={()=>this.closeFilters()}><View><Icon size={32} name="close" color='#FF3B70' type="material-community" /></View></TouchableHighlight>
    );
    let cityItems = this.state.city_list && this.state.city_list.map( (city, i) => {
      return <Picker.Item key={i} value={city.city_name} label={city.city_name} />
    });
    let areaItems = this.state.area_list && this.state.area_list.map( (area, i) => {
      return <Picker.Item key={i} value={area.locality} label={area.locality} />
    });
    let text = 'Waiting..';
    if (this.state.errorMessage) {
      text = this.state.errorMessage;
    } else if (this.state.location) {
      text = JSON.stringify(this.state.location);
    } 
    return (
      
      <View style={{flex: 1,backgroundColor:'#f5f5f5'}}>
      <Loader loading={this.state.loading} />
      <Header leftComponent={<LeftComponent navigation={this.props.navigation} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />} />
      <View style={{flexDirection:'row'}}>
        <View style={{flex:3}}>
        <SearchBar 
          showLoading
          lightTheme
          onChange={this.setSearchText.bind(this)}
          placeholder='Search' />
        </View>
        <View style={{flex:1,flexDirection:'column',justifyContent:'center',alignItems:'center',padding:2,backgroundColor: '#e1e8ee',
    borderTopColor: '#e1e1e1',
    borderBottomColor: '#e1e1e1'}} >
          <Icon onPress={()=>this.openFilters()} containerStyle={{transform: [{ rotate: '270deg'}]}} name="equalizer" color={this.state.filterColor}  type="simple-line-icon" size={24} /><Text style={{fontSize:11}}>Filters</Text>
        </View>
      </View>
      <ScrollView>
      {this.state.noData &&
            <View style={{backgroundColor:'#FFF',justifyContent:'center',alignItems:'center',padding:10}}> 
              <Icon size={28} name="magnifier" type="simple-line-icon" />
              <Text>We couldn't find any matching results for your search!</Text>
            </View>

      }
        {
          this.state.renderedListData && !this.state.noData && this.state.renderedListData.map((vendor,index) =>
          <TouchableHighlight key={index} onPress={() => this.props.navigation.navigate('Service',{vendorId:vendor.id})}>
          <Card 
            title={vendor.shop_name}
            titleStyle={{fontSize:26,color:'#FF3B70'}}
            image={{uri: config.public_image_url+'public/'+vendor.photo}}>
            <View style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline'}}>
            <Icon name="map-marker" type="font-awesome" color="#FF3B70" />
            <Text style={{marginBottom: 10}}>
              {vendor.addr+','+vendor.city}
            </Text>
            </View>
            <View style={{flexDirection:'row',justifyContent:"space-between",alignItems: 'baseline'}}>
            <Icon name="clock-o" type="font-awesome" color="#FF3B70" />
            <Text> {vendor.open_at} - {vendor.close_at}</Text>
            <Button
                  buttonStyle={styles.button}
                  style={{borderRadius: 30}}
                  title='View More' onPress={() => this.props.navigation.navigate('Service',{vendorId:vendor.id})}/>
            </View>
          </Card>
          </TouchableHighlight>
          )}
          {!this.state.renderedListData &&
            <View style={{backgroundColor:'#FFF',justifyContent:'center',alignItems:'center',padding:10}}> 
              <Icon size={28} name="magnifier" type="simple-line-icon" />
              <Text>{this.state.message}</Text>
            </View>
          }
          <Modal visible={this.state.isModalOpen}
                onRequestClose={() => this.setState({isModalOpen: false})} animationType={"slide"}
               >
                <View  style={{flex: 1,backgroundColor:'#f5f5f5'}}> 
                  <Header outerContainerStyles={{backgroundColor:'#fff'}}  leftComponent={<CloseComponent />}
                      centerComponent={{ text: 'Filters', style: { color: '#FF3B70',fontWeight:'bold',fontSize:22 } }}
                      />
                  <Text style={{fontSize:20,fontWeight:'400',padding:5}}>Price Range</Text>
                  
                    <View>
                      <Slider
                          thumbTintColor='#FF3B70'
                          minimumValue={this.state.min_price}
                          maximumValue={this.state.max_price}
                          step={10}
                          value={this.state.value}
                          onValueChange={(value) => this.setState({value})} />
                      <View style={{flexDirection:'row',justifyContent:'center'}}>
                      <Text><Icon component={Text} name="inr" type="font-awesome" /> {this.state.min_price} - {this.state.value}</Text>
                      </View>
                    </View> 
                  
                  
                  <Text style={{fontSize:20,fontWeight:'400',padding:5}}>Gender</Text>
                  <View  style={styles.container}>
                  <CheckBox
                    center
                    title='Gents'
                    checkedIcon='dot-circle-o'
                    uncheckedIcon='circle-o'
                    checked={this.state.male}
                    onPress={()=> this.changeCheckBox('Male')}
                  />
                  <CheckBox
                    center
                    title='Ladies'
                    checkedIcon='dot-circle-o'
                    uncheckedIcon='circle-o'
                    checked={this.state.female}
                    onPress={()=> this.changeCheckBox('Female')}
                  />
                  <CheckBox
                    center
                    title='Unisex'
                    checkedIcon='dot-circle-o'
                    uncheckedIcon='circle-o'
                    checked={this.state.others}
                    onPress={()=> this.changeCheckBox('Both')}
                  />
                  </View>
                  <View>
                  <Text style={{fontSize:20,fontWeight:'400',padding:5}}>City</Text>
                    <Picker
                        selectedValue={this.state.selected_city}
                        onValueChange={(city_name, index) => this.setState({selected_city : city_name})}>
                        {cityItems}
                    </Picker>
                  </View>
                  <View>
                  <Text style={{fontSize:20,fontWeight:'400',padding:5}}>Area/Locality</Text>
                    <Picker
                        selectedValue={this.state.selected_area}
                        onValueChange={(locality, index) => this.setState({selected_area : locality})}>
                        {areaItems}
                    </Picker>
                  </View>
                  <Button
                        onPress={()=> this.apply()}
                        backgroundColor='#34bfa3'
                        buttonStyle={{borderRadius: 30, marginTop:20,marginLeft: 0, marginRight: 0, marginBottom: 0}}
                        title='Apply' />
                  { this.state.apply && 
                  <Button
                        onPress={()=> this.reset()}
                        backgroundColor='#34bfa3'
                        buttonStyle={{borderRadius: 30, marginTop:20,marginLeft: 0, marginRight: 0, marginBottom: 0}}
                        title='Reset' />
                  }
                </View>
              </Modal>
      </ScrollView>      
      </View>
    );
  }
}
const styles = StyleSheet.create({
  button: {
    borderRadius: 30,
    backgroundColor:'#FF3B70'
  },
  icon:{
    color:'#FF3B70'
  },
  container: {
    margin: 5,
    marginLeft: 10,
    marginRight: 10,
    padding: 10,
    borderWidth: 1,
    borderRadius: 3,
    backgroundColor: '#fafafa',
    borderColor: '#ededed',
    height:50,
    flexDirection:'row',
    justifyContent:'center',
    alignItems:'center'
  }
})




