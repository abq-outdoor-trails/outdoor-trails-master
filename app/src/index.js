import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import {Route, Switch} from "react-router";

import thunk from "redux-thunk";
import {applyMiddleware, createStore} from "redux";
import reducers from "./shared/reducers";
import {Provider} from "react-redux";

import 'bootstrap/dist/css/bootstrap.css';
import "./index.css";
import {Header} from "./shared/components/header/Header";
import {Footer} from "./shared/components/footer/Footer";
import {Home} from "./pages/home/Home";
import {Signup} from "./pages/sign-up/Signup";
import {FourOhFour} from "./pages/four-oh-four/FourOhFour";
import {RouteMap} from "./pages/route-map/RouteMap";
// import {Map} from "./pages/route-map/RouteMapGL";




import { library } from '@fortawesome/fontawesome-svg-core';
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
} from "@fortawesome/free-solid-svg-icons";
import {faGithub, faLinkedin} from "@fortawesome/free-brands-svg-icons";

const store = createStore(reducers,applyMiddleware(thunk));



library.add(faPencilAlt, faUserCircle, faSortDown, faEnvelope, faKey, faSignInAlt, faDog, faTrash, faHeart, faGithub, faLinkedin);


const App = (store) => (
	<>
		<Provider store={store}>
	 	<BrowserRouter>
			<div className="sfooter-content">
				<Header/>
				<Switch>
					<Route exact path="/" component={Home} />
					<Route exact path="/signup" component={Signup} />
					<Route exact path="/route/:routeId" component={RouteMap} />
					<Route component={FourOhFour} />
				</Switch>
			</div>
			<Footer/>
		 </BrowserRouter>
		</Provider>
	</>
);
ReactDOM.render(App(store) , document.querySelector("#root"));