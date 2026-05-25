import React from "react"
/*Navbar*/
import NavbarAll from './components/navbar_all'
/*Card*/
import { Container, Card, Button } from "react-bootstrap"
import { Link } from 'react-router-dom'
/*Footer*/
import FooterAll from "./components/footer2.js"
/*Images
import Placeholder from "./imgs/placeholder.png"*/

export default class Cats extends React.Component {

  constructor(props) {
      super(props)
      this.state = {
          pets: []
      }
  }


  componentDidMount() {
      let self = this;
      fetch('http://localhost:8000', {
          method: 'GET'
      }).then(function(response) {
          if (response.status >= 400) {
              throw new Error("Bad response from server");
          }
          return response.json();
      }).then(function(data) {
          self.setState({pets: data});
          console.log(data);
      }).catch(err => {
      console.log('caught it!',err);
      })
  }

  render() {
    return (
      <div id="app">
        <NavbarAll />
  
        <Container fluid id="petsmain">
                {this.state.pets.map(pet =>
              <Card border="info" id="card" style={{ width: "18rem" }}>
                <Card.Img variant="top" src={pet.cat_url} alt="Cat" />
                <Card.Body>
                <Card.Title>{pet.cat_name}</Card.Title>
                  <Card.Text>{pet.cat_description}</Card.Text>
                </Card.Body>
              </Card>)}
        </Container>
  
        <FooterAll />
      </div>
    ) 
  }
}