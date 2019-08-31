import axios from "axios";

export const httpConfig = axios.create();

httpConfig.interceptors.response.use(({data, headers}) => {
	if(data.status === 200) {
		return data.data !== null
			? {message: null, status: 200, type: "alert alert-success", data: data.data, headers: {...headers}}
			: {message: data.message, status: 200, type: "alert alert-success", data: null, headers: {...headers}};
	}
	return {message: data.message, status: data.status, type: "alert alert-danger", data: null, headers: {...headers}}
}, error => {
	// Do something with response error
	console.log(error);
	return Promise.reject(error);
});