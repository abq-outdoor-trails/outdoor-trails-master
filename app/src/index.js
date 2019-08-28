import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import {Route, Switch} from "react-router";

import 'bootstrap/dist/css/bootstrap.css';

import "./index.css";
import {Header} from "./shared/Header";
import {Footer} from "./shared/Footer";
import {Home} from "./pages/Home";
import {Signup} from "./pages/Signup";
import {FourOhFour} from "./pages/FourOhFour";
import {SingleRoutePage} from "./pages/SingleRoutePage";


import { library } from '@fortawesome/fontawesome-svg-core';
import {
	faEnvelope,
	faPencilAlt,
	faSignInAlt,
	faSortDown,
	faUserCircle,
	faKey,
	faDog
} from "@fortawesome/free-solid-svg-icons";





library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog );


const App = () => (
	<>
	 	<BrowserRouter>
			<Header/>
			<Switch>
				<Route component={FourOhFour} />
				<Route exact path="/" component={Home} />
				<Route exact path="/Signup" component={Signup} />
				<Route exact path="/SingleRoutePage" component={SingleRoutePage} />
			</Switch>
			<Footer/>
		 </BrowserRouter>
	</>
);
ReactDOM.render(<App/>, document.querySelector('#root'));