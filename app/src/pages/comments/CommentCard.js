import React from "react";
import {httpConfig} from "../../shared/utils/http-config";

import {UseJwt, useJwt, UseJwtUserId} from "../../shared/utils/JwtHelpers";
import {handleSessionTimeout} from "../../shared/utils/handle-session-timeout";

import {Favorite} from "../Favorite";
import {PostEdit} from "./PostEdit";
import {PostUsername} from "./PostUsername"

import Badge from "react-bootstrap/Badge";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const CommentCard = ({comment}) => {

	//grab jwt and jwt profile id of logged in users
	const jwt = UseJwt();
	const userId = UseJwtUserId();

	const deletePost = () => {
		const headers = {'X-JWT-TOKEN': jwt};
		const params = {id: post.userId};
		let confirm = window.confirm("Are you sure you want to delete this?");
		if(confirm){
			httpConfig.delete("/apis/comment", {
				headers, params})
				.then(reply => {
					let {message, type} = reply;
					if(reply.status === 200) {
							window.location.reload();
					}
					//if there's an issue with a $_SESSION mismatch with xsrf or jwt alert user and sign out
					if(reply.status === 401) {
						handleSessionTimeout();
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
					<Card.Text className="mb-3">
						<Card.Header>
							<h3 className="panel-title my-0">{post.postTitle}</h3>
						</Card.Header>
						<Card.Body>
							<div className="d-flex justify-content-end">
								<h6 className="d-inline-block">
									<Badge className="p-1 mr-2" variant="secondary">By:&nbsp;
										<CommentUsername userId={post.commentUserId} />
									</Badge>
								</h6>
								{formatDate.format(comment.commentDate)}
							</div>

							{/* conditional render del $ edit buttons if logged into account that created them */}
							{(userId === comment.commentUserId) && (
								<>
									<Button onClick={deletePost} variant="outline-secondary" size="sm" className="mr-2">
										<FontAwesomeIcon icon="trash-alt"/>
									</Button>
									</>


							)}

							<Like userId={userId} commentId={comment.commentId}/>
						</div>
						<hr />
					</Card.Text>{comment.comment.Content}</Card.Text>
				</Card.Body>
		</Card>
	</>
	)


};