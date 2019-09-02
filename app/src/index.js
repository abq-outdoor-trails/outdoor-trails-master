import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import {Route, Switch} from "react-router";

import 'bootstrap/dist/css/bootstrap.css';
import "./index.css";
import {Header} from "./shared/components/header/Header";
import {Footer} from "./shared/components/footer/Footer";
import {Home} from "./pages/home/Home";
import {Signup} from "./pages/sign-up/Signup";
import {FourOhFour} from "./pages/four-oh-four/FourOhFour";
import {RouteMap} from "./pages/route-map/RouteMap";
import {Map} from "./pages/route-map/RouteMapGL";



import { library } from '@fortawesome/fontawesome-svg-core';
// import {far} from "@fortawesome/free-solid-svg-icons";
// import {fab, faGithub} from "@fortawesome/free-brands-svg-icons";
import {
	faDog,
	faEnvelope,
	faKey,
	faPencilAlt,
	faHeart,
	faTrash,
	faSignInAlt,
	faSortDown,
	faUserCircle,
	faUser
} from "@fortawesome/free-solid-svg-icons";





library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog, faTrash, faHeart);


const App = () => (
	<>
	 	<BrowserRouter>
			<div className="sfooter-content">
				<Header/>
				<Switch>
					<Route exact path="/" component={Home} />
					<Route exact path="/signup" component={Signup} />
					<Route exact path="/route" component={Map} />
					<Route component={FourOhFour} />
				</Switch>
			</div>
			<Footer/>
		 </BrowserRouter>
	</>
);
ReactDOM.render(<App/>, document.querySelector('#root'));