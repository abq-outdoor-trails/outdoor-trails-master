import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import {Route, Switch} from "react-router";

import 'bootstrap/dist/css/bootstrap.css';

import "./index.css";
import {Header} from "./shared/Header";
import {Footer} from "./shared/Footer";
import {Home} from "./pages/Home";
import {AboutUs}
import {FourOhFour} from "./pages/FourOhFour";


import {Signup} from "./pages/Signup";
import {
	faEnvelope,
	faPencilAlt,
	faSignInAlt,
	faSortDown,
	faUserCircle,
	faKey,
	faDog
} from "@fortawesome/free-solid-svg-icons";
import {AllRoutesMap} from "./pages/AllRoutesMap";
import {SingleRotePage} from "./pages/SingleRoutePage";

import { library } from '@fortawesome/fontawesome-svg-core';


library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog );


const App = () => (
	<>
	 	<BrowserRouter>
			<Header/>
			<Switch>
				<Route exact path="/" component={Home} />
				<Route exact path="/signup" component={Signup} />
				/*<Route exact path="/route/:routeId" component={Route} /> */
				<Route exact path="/AllRoutesMap" component={AllRoutesMap} />
				<Route exact path="/SingleRoutePage" component={SingleRotePage} />
				<Route component={FourOhFour} />
			</Switch>
		 </BrowserRouter>
	</>
);
ReactDOM.render(<App/>, document.querySelector('#root'));