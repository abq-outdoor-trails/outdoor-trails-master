import React, {useState} from 'react';
import {httpConfig} from "../../shared/utils/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {SignUpFormContent} from "./SignUpFormContent";

// define 'state variables' to be used in sign up form
export const SignUpForm = () => {
	const signUp = {
		userName: "",
		userEmail: "",
		userHash: "",
		userHashConfirm: "",
	};

	// set status and setStatus to null initial state
	const [status, setStatus] = useState(null);
	// init yup validator
	const validator = Yup.object().shape({
		userName: Yup.string()
			.required("user name is required"),
		userEmail: Yup.string()
			.email("email must be a valid email")
			.required("email is required"),
		userHash: Yup.string()
			.required("password is required")
			.min(8, "password must be at least 8 characters"),
		userHashConfirm: Yup.string()
			.required("please confirm password")
			.min(8, "password must be at least 8 characters")
	});

	// define sign up form submit handler
	const submitSignUp = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/sign-up/", values)
			.then(reply => {
				let { message, type } = reply;
				setStatus({ message, type });
				if(reply.status === 200) {
					resetForm();
					setStatus({message, type});
				}
			});
	};
	// return Formik component
	return (
		<>

			<Formik
				initialValues={ signUp }
				onSubmit={ submitSignUp}
				validationSchema={ validator }
			>
				{ SignUpFormContent }
			</Formik>
		</>
	);
};