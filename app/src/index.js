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
// import {far} from "@fortawesome/free-solid-svg-icons";
// import {fab, faGithub} from "@fortawesome/free-brands-svg-icons";
import {
	faDog,
	faEnvelope,
	faKey,
	faPencilAlt,
	faSignInAlt,
	faSortDown,
	faUserCircle,
	faUser
} from "@fortawesome/free-solid-svg-icons";





library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog );


const App = () => (
	<>
	 	<BrowserRouter>
			<div className="sfooter-content">
				<Header/>
				<Switch>
					<Route exact path="/" component={Home} />
					<Route exact path="/signup" component={Signup} />
					<Route exact path="/route" component={SingleRoutePage} />
					<Route component={FourOhFour} />
				</Switch>
			</div>
			<Footer/>
		 </BrowserRouter>
	</>
);
ReactDOM.render(<App/>, document.querySelector('#root'));