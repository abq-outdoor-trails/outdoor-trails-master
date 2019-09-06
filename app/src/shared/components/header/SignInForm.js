import React from 'react';
import {Formik} from "formik/dist/index";
import * as Yup from "yup";
import {SignInFormContent} from "./SignInFormContent";
import {httpConfig} from "../../utils/http-config";


export const SignInForm = () => {
	//the initial values object defines what the request payload is.
	const signIn = {
		userEmail: "",
		userHash: ""
	};
	const validator = Yup.object().shape({
		userEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		userHash: Yup.string()
			.required("Password is required")
			.min(8, "Password must be at least 8 characters")
	});



	const submitSignIn = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/sign-in/", values)
			.then(reply => {
				let {message, type} = reply;
				if(reply.status === 200 && reply.headers["x-jwt-token"]) {
					window.localStorage.removeItem("jwt-token");
					window.localStorage.setItem("jwt-token", reply.headers["x-jwt-token"]);
					resetForm();

					setTimeout(() => {
						window.location = "/";
					}, 1500);

				}
				setStatus({message, type});

			});
	};

	return (
		<Formik
			initialValues={signIn}
			onSubmit={submitSignIn}
			validationSchema={validator}
		>
			{SignInFormContent}
		</Formik>
	)


};