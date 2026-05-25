import React from 'react';
import ReactDOM from 'react-dom';
import { Route, BrowserRouter as Router } from 'react-router-dom'
import './index.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import Contact from './Contact'
import Cats from './Cats'
import Dogs from './Dogs'
import Login from './Login'
import Register from './Register'
import About from './About'
import Sponsors from './Sponsors'
import Info from './Info'

const routing = (
    <Router>
        <div>
            <Route exact path="/" component={App} />
            <Route exact path="/Contact" component={Contact} />
            <Route exact path="/Cats" component={Cats} />
            <Route exact path="/Dogs" component={Dogs} />
            <Route exact path="/Login" component={Login} />
            <Route exact path="/Register" component={Register} />
            <Route exact path="/About" component={About} />
            <Route exact path="/Sponsors" component={Sponsors} />
            <Route exact path="/Info" component={Info} />
        </div>
    </Router>
)

ReactDOM.render(routing, document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
