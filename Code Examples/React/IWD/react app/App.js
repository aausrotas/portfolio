import React from 'react'
/*Navbar*/
import NavBarMain from './components/navbar_main'
/*Jumbotron*/
import {Link} from 'react-router-dom'
import { Container, Image, Row, Col } from 'react-bootstrap'
/*Footer*/
import Footer from './components/footer'
/*Images*/
import CatPic from './imgs/cat1.jpg'
import DogPic from './imgs/dog1.jpg'

class App extends React.Component {
  render() {
    return(
<div id="App">

<NavBarMain />

<Container fluid id="main">
    <Row>
      <Col id="adopthover">
        <Link to="/Cats">
          <Image src={CatPic} roundedCircle fluid class="image" />
          <div class="overlay"><h3 className="text">ADOPT A CAT</h3></div>
          </Link>
      </Col>
      <Col id="adopthover">
        <Link to ="/Dogs">
          <Image src={DogPic} roundedCircle fluid className="image" />
          <div class="overlay"><h3 className="text">ADOPT A DOG</h3></div>
        </Link>
      </Col>
    </Row>
</Container>

<Footer />

</div>
    )
  }
}

export default App;
