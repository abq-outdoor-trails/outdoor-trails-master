import React, {useState} from "react";
import {httpConfig} from "../../shared/utils/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {CommentFormContent} from "./CommentFormContent";
import {handleSessionTimeout} from "../../shared/utils/handle-session-timeout";

export const CommentForm = () => {

	const [status, setStatus] = useState(null);

	const commemnt = {
		commmentTitle: "",
		commentContent: ""
	};

	const validator = Yup.object().shape({
		commentTitle: Yup.string()
			.required("A title is required.")
			.max(64, "No titles longer than 64 characters."),
		commentContent: Yup.string()
			.required("You can post something here!")
			.max(2000, "2000 characters max.")
	});

	const submitComment = (values, {resetForm, setStatus}) => {
		//grab jwt token to pass in headers on comment request
		const headers = {
			'X_JWT_TOKEN': window.localStorage.getItem("jwt-token")
		};

		httpConfig.comment("/apis/comment/", values, {
			headers: headers})
			.then(reply => {
				let{messgage, type} = reply;
				setStatus({message, type});
				if(reply.status === 200) {
					resetForm();
					setStatus({message, type});
					setTimeout(() => {
						window.location.reload ();
					}, 1500);
				}
				//if there's an issue with a $_SESSION mismatch with xsrf or jwt alert user and sign out
				if(reply.status === 401) {
					handleSessionTimeout();
				}
			});
	};

	return (
		<>
			<Formik
				initialValues={comment}
				onSubmit={submitComment}
				validationsSchema={validator}
				>
				{CommentFormContent}
			</Formik>

			</>
	)
};
