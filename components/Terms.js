import React from 'react';
import {View,StyleSheet,Text,ScrollView} from 'react-native';
import {Icon,Header, Card} from 'react-native-elements';
import BackComponent from '../common/BackComponent';
import LogoComponent from '../common/LogoComponent';
//Terms Class 
class Terms extends React.Component {
    static navigationOptions = {
      drawerLabel: 'Terms & Conditions',
      drawerIcon: ({ tintColor }) => (
        <Icon
              name={'pencil'}
              size={30}
              type="font-awesome"
              color={tintColor}
            />
      ),
    };
  
    render() {
      return (
        <View style={{flex: 1,backgroundColor:'#f0f3f7'}}>
          <Header leftComponent={<BackComponent navigation={this.props.navigation} />} outerContainerStyles={{paddingBottom:10,backgroundColor:'#FFF'}}  centerComponent={<LogoComponent />}/> 
          <ScrollView>
            <Card 
             title="Terms and Conditions"
             titleStyle={{fontSize:26,color:'#FF3B70'}} >
            <View>
              <Text style={{fontSize:24,fontWeight:'bold'}}>Your Acceptance:</Text>
              <Text style={{textAlign:'justify'}}>
                This is an agreement between MyStyle Micro Enterprise, the sole owner and operator of the application, a user of the Service. BY USING THE SERVICE, YOU ACKNOWLEDGE AND AGREE TO THESE TERMS OF SERVICE, AND MyStyle’s PRIVACY POLICY, WHICH CAN BE FOUND AT http://mystyletech.com/policy, AND WHICH ARE INCORPORATED HEREIN BY REFERENCE. If you choose to not agree with any of these terms, you may not use the Service.
              </Text>
              <Text style={{textAlign:'justify'}}>
              These Terms of Use are subject to revision by MyStyle at any time and hence the Users are requested to carefully read these Terms of Use from time to time before using the application. The revised Terms of Use shall be made available on the Application & Website. You are requested to regularly visit the Website to view the most current Terms of Use. It shall be Your responsibility to check these Terms of Use periodically for changes. MyStyle may require You to provide Your direct or indirect consent to any update in a specified manner before further use of the Website,Mobile App and the Services. If no such separate consent is sought, Your continued use of the Website and/or Services, following such changes, will constitute Your acceptance of those changes.
              </Text>
              <Text style={{fontSize:24,fontWeight:'bold'}}>
              MyStyle Service:
              </Text>
              <Text style={{textAlign:'justify'}}>
              These Terms of Service apply to all users of the MyStyle services. Information provided by our users through the MyStyle Service may contain links to third party websites that are not owned or controlled by MyStyle. MyStyle has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party websites. In addition, MyStyle will not and cannot censor or edit the content of any third-party site. By using the Service, you expressly acknowledge and agree that MyStyle shall not be responsible for any damages, claims or other liability arising from or related to your use of any third-party website.
              </Text>
              <Text style={{fontSize:24,fontWeight:'bold'}} >
              Service Accessibility:
              </Text>
              <Text style={{textAlign:'justify'}}>
              1. Subject to your compliance with these Terms of Service, MyStyle hereby grants you permission to use the Service, provided that:

              </Text>
              <Text style={{textAlign:'justify'}}>
                I.your use of the Service as permitted is solely for your personal use, and you are not permitted to resell or charge others for use of or access to the Service, or in any other manner inconsistent with these Terms of Service;
              </Text>
              <Text style={{textAlign:'justify'}}>
                II.you will not duplicate, transfer, give access to, copy or distribute any part of the Service in any medium without MyStyle's prior written authorization;
              </Text>
              <Text>
                III.you will not attempt to reverse engineer, alter or modify any part of the Service; and
              </Text>
              <Text style={{textAlign:'justify'}}>
                IV.you will otherwise comply with the terms and conditions of these Terms of Service and Privacy Policy.
              </Text>
              <Text style={{textAlign:'justify'}}>
              2.In order to access and use the features of the Service, you acknowledge and agree that you will have to provide MyStyle with your mobile phone number. You expressly acknowledge and agree that in order to provide the Service, when providing your mobile phone number, you must provide accurate and complete information.  We collect the mobile phone number of all users, and the e-mail address of users who opt in to receive e-mail newsletters during registration. You must notify MyStyle immediately of any breach of security or unauthorized use of your mobile phone. Although MyStyle will not be liable for your losses caused by any unauthorized use of your account, you may be liable for the losses of MyStyle or others due to such unauthorized use.
              </Text>
              <Text style={{textAlign:'justify'}}>
              3.You agree not to use or launch any automated system, including without limitation, "robots", "spiders", "offline readers" etc. or "load testers" such as wget, apache bench, mswebstress, httpload, blitz, Xcode Automator, Android Monkey, etc., that accesses the Service in a manner that sends more request messages to the MyStyle servers in a given period of time than a human can reasonably produce in the same period by using a MyStyle application, and you are forbidden from ripping the content unless specifically allowed. Notwithstanding the foregoing, MyStyle grants the operators of public search engines permission to use spiders to copy materials from the website for the sole purpose of creating publicly available searchable indices of the materials, but not caches or archives of such materials. MyStyle reserves the right to revoke these exceptions either generally or in specific cases. While we don't disallow the use of sniffers such as Ethereal, tcpdump or HTTPWatch in general, we do disallow any efforts to reverse-engineer our system, our protocols, or explore outside the boundaries of the normal requests made by MyStyle clients. We have to disallow using request modification tools such as fiddler or whisker, or the like or any other such tools activities that are meant to explore or harm, penetrate or test the site. You must secure our permission before you measure, test, health check or otherwise monitor any network equipment, servers or assets hosted on our domain. You agree not to collect or harvest any personally identifiable information, including phone number, from the Service, nor to use the communication systems provided by the Service for any commercial solicitation or spam purposes. You agree not to spam, or solicit for commercial purposes, any users of the Service.
              </Text>
              <Text style={{textAlign:'justify'}}>
              Intellectual Property Rights:
              </Text>
              <Text style={{textAlign:'justify'}}>
              The design of the MyStyle Service along with all associated properties, are owned by or licensed to MyStyle, subject to copyright and other intellectual property rights under Indian Law. The Service is provided to you AS IS for your information and personal use only. MyStyle reserves all rights not expressly granted in and to the Service. You agree to not engage in the use, copying, or distribution of any of the Service other than expressly permitted herein, including any use, copying, or distribution of Status Submissions of third parties obtained through the Service for any commercial purposes.
              </Text>
            </View>
          </Card>
          </ScrollView>
        </View>
      );
    }
  }
  
//Export the module
export default Terms;