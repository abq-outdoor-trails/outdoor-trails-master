import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import { BrowserRouter } from "react-router-dom";
import {Route, Switch} from "react-router";
import {Home} from "./pages/Home";
import {FourOhFour} from "./pages/FourOhFour";
import { library } from '@fortawesome/fontawesome-svg-core'

import "./index.css";
import {Navbar} from "./shared/NavBar";
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


library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog );


const App = () => (
	<>
	 	<BrowserRouter>
			<Navbar/>
			<Switch>
				<Route exact path="/" component={Home} />
				<Route exact path="/signup" component={Signup} />
				<Route exact path="/route/:routeId" component={Route} />
				<Route component={FourOhFour} />
			</Switch>
		 </BrowserRouter>
	</>
);
ReactDOM.render(<App/>, document.querySelector('#root'));