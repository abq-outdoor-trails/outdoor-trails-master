import React, {useEffect, useState} from "react";
import {Link} from "react-router-dom";
import ReactMapboxGl, { Layer, Feature, MapContext } from 'react-mapbox-gl';

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {CommentCard} from "../comments/CommentCard";
import {CommentForm} from "../comments/CommentForm";
import {useDispatch, useSelector} from "react-redux";
import {getCommentsAndUsersByRouteId} from "../../shared/actions/get-comment";
import {getRouteByRouteId} from "../../shared/actions/get-route";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Badge from "react-bootstrap/Badge";
import Button from "react-bootstrap/Button";
import {UseJwt} from "../../shared/utils/JwtHelpers";
import {ZoomControl} from "react-mapbox-gl";

export const RouteMap = ({match}) => {

	const Map = ReactMapboxGl({
		accessToken: 'pk.eyJ1Ijoid2hhcnJpcyIsImEiOiJjanp3cmVkdHMwMnkzM2JwbThiYXd3YWJtIn0.LYO1SzQdH7Q8p1as8N3dMA',
	});

	const routeId =  match.params.routeId;

	const comments = useSelector(state => (state.comments ? state.comments : []));

	const route = useSelector(state => (state.route ? state.route :[]));

	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getCommentsAndUsersByRouteId(routeId));
		dispatch(getRouteByRouteId(routeId));
	};

	const inputs = [routeId];

	useEffect(effects, inputs);

	let tempCoordinates = [[[-106.72596911799997,35.16587166100004],[-106.72600261899998,35.16588754600008],[-106.72577025299995,35.16630908600007],[-106.72573252899997,35.16641465300006],[-106.72565680499997,35.16677795800007],[-106.72565236899999,35.16682466700007],[-106.72565583399995,35.16687143200005],[-106.72566713299994,35.166917356000056],[-106.72568604999998,35.166961557000036],[-106.72571222299996,35.16700318900007],[-106.72574514799999,35.167041452000035],[-106.72578419499996,35.167075613000065],[-106.72582861499995,35.16710501700004],[-106.72587755599994,35.16712909900008],[-106.72604862599997,35.167178826000054]],[[-106.72547828499995,35.16573037000006],[-106.72548333599997,35.165722008000046],[-106.72565498699998,35.16542414800006],[-106.72566196099996,35.16540900600006],[-106.72566589599995,35.165393143000074],[-106.72566668899998,35.16537696700004],[-106.72566431899997,35.16536089600004],[-106.72565884899996,35.16534534300007],[-106.72565041799999,35.165330709000045],[-106.72563924399998,35.16531737200006],[-106.72562561499996,35.165305674000024],[-106.72560988199996,35.16529591900007],[-106.72533989499999,35.16515492700006],[-106.72479823699996,35.16485488300003],[-106.72444455499999,35.164646841000035],[-106.72430053499994,35.16454975600004],[-106.72413482299999,35.164397165000025],[-106.72404788899996,35.16430627500006],[-106.72391511799998,35.16412777800008],[-106.72376969499999,35.16391382900008],[-106.72360381599998,35.16360680400004],[-106.72338935499994,35.16318548600003],[-106.72317700299999,35.16287745100004],[-106.72300269999994,35.162619352000036],[-106.72261838999998,35.16208123200005],[-106.72210623799998,35.16141064300007],[-106.72197890299998,35.16122567900004],[-106.72171036699996,35.160876737000024],[-106.72143576399998,35.16059934800006],[-106.72129501999996,35.16048420200008],[-106.72077080199995,35.16010701500005],[-106.72070076199998,35.160057220000056]]];


	const [coordinates, setCoordinates] = useState(tempCoordinates);

	const getCurrentPosition = () => {
		window.navigator.geolocation.getCurrentPosition(position => {
			let currentPosition = position;
			let latitude = currentPosition.coords.latitude;
			let longitude = currentPosition.coords.longitude;
			return [longitude, latitude];
		})
	};

	return (
		<>
			<main>
				<section>
					<Container>
						<Row>
							<Col>
								<h2>Bosque Trail</h2>
								<Map
									style="mapbox://styles/mapbox/streets-v9"
									containerStyle={{
										height: '50vh',
										width: '50vw'
									}}
									center={[-106.6505556, 35.0844444]}
									// onStyleLoad={(map) => {
									// 	map.addControl(map.GeolocateControl({
									// 		positionOptions: {
									// 			enableHighAccuracy: true
									// 		},
									// 		trackUserLocation: true
									// 	}));
									// }}
								>
									<ZoomControl/>
									<Layer
										type="line"
										layout={{
										'line-cap': 'round',
										'line-join': 'round'
									}}
										paint={{
										'line-color': '#4790E5',
										'line-width': 4
									}}
									>{coordinates.map(point => <Feature coordinates={point} />)}
									</Layer>
								</Map>
							</Col>
						</Row>
					</Container>
				</section>

				<section className="py-5">
					<Container fluid="true">
						<Row>
							<Button variant="outline-danger" size="sm">
								<FontAwesomeIcon icon="heart"/>&nbsp;
								<Badge variant="danger">94</Badge>
							</Button>
							<Col md="4">
								<div id="comment-wrapper">
									<h3>Post a Comment</h3>
									<CommentForm routeId={routeId}/>
								</div>
							</Col>

							<Col md={{span:7, offset: 1}}>
								{comments.map(comment =>
									<CommentCard comment={comment} key={comment.commentId} />
								)}
							</Col>
						</Row>
					</Container>
				</section>
			</main>
		</>
	)
};
