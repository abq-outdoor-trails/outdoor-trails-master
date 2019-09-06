
import React from "react";
import {httpConfig} from "../../shared/utils/http-config";

import {UseJwt, UseJwtUserId} from "../../shared/utils/JwtHelpers";

import Badge from "react-bootstrap/Badge";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {CommentUserName} from "./CommentUsername";

export const CommentCard = ({comment}) => {

	//grab jwt and jwt profile id of logged in users
	const jwt = UseJwt();
	const userId = UseJwtUserId();
	console.log(comment);

	const deleteComment = () => {
		const headers = {'X-JWT-TOKEN': jwt};
		const params = {id: comment.commentId};
		let confirm = window.confirm("Are you sure you want to delete this?");
		if(confirm){
			httpConfig.delete("/apis/comment/", {
				headers, params})
				.then(reply => {
					let {message, type} = reply;
					if(reply.status === 200) {
						window.location.reload();
					}
				});
		}
	};

	const formatDate = new Intl.DateTimeFormat('en-US', {
		day: 'numeric',
		month: 'numeric',
		year: '2-digit',
		hour: 'numeric',
		minute: 'numeric',
		second: '2-digit',
		timeZoneName: 'short'
	});

	return (
		<>
			<Card className="mb-3">
				<Card.Body>
					<div className="d-flex justify-content-end">
						<div className="d-inline-block small text-muted mr-auto my-auto"><CommentUserName userId={comment.commentUserId}/> | {formatDate.format(comment.commentDate)} </div>
						<Button onClick={deleteComment} variant="outline-secondary" size="sm" className="mr-2">
							<FontAwesomeIcon icon="trash"/>
						</Button>
						{/*<Button variant="outline-secondary" size="sm" className="mr-2">*/}
						{/*	<FontAwesomeIcon icon="pencil-alt"/>*/}
						{/*</Button>*/}

					</div>
					<hr />

					<Card.Text>{comment.commentContent}</Card.Text>
				</Card.Body>
			</Card>
		</>
	)


};