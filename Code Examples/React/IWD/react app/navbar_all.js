import React from 'react'
import { Link } from 'react-router-dom'

import { Navbar, Nav, NavDropdown, Button } from 'react-bootstrap'

export default function NavBarMain() {
    return (
        <Navbar id="navbarall">
            <Navbar.Brand as={Link} to="/">Andi's Adoption</Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="mr-auto">
            <Nav.Link as={Link} to="/Cats">Cats</Nav.Link>
            <Nav.Link as={Link} to="/Dogs">Dogs</Nav.Link>
            <Nav.Link as={Link} to="/Info">How to Adopt</Nav.Link>
            </Nav>
            </Navbar.Collapse>
            {/*<Navbar.Collapse className="justify-content-end">
                <Navbar.Text>
                <Button variant="outline-dark" as={Link} to="/Login">Login</Button>
                </Navbar.Text>
            </Navbar.Collapse>*/}
        </Navbar>
    )
}