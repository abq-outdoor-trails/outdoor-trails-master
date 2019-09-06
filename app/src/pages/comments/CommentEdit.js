import React, {useState} from 'react';

import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const CommentEdit = ({commentId}) => {

	const [show, setShow] = useState(false);
	const handleClose = () => setShow(false);
	const handleShow = () => setShow(true);

	return (
		<>
			<Button onClick={handleShow} variant="outline-secondary" size="sm" className="mr-2">
				<FontAwesomeIcon icon="pencil-alt"/>
			</Button>

			{/*Modal Window / Edit Comment Form */}
			<Modal show={show} onHide={handleClose} centered>
				<Modal.Header closeButton>
					<Modal.Title>Editing Comment #{commentId}</Modal.Title>
				</Modal.Header>
				<Modal.Body>Editing Comment</Modal.Body>
				<Modal.Footer>
					<Button variant="secondary" onClick={handleClose}>
						Cancel
					</Button>
					<Button variant="primary" onClick={handleClose}>
						Save Changes
					</Button>
				</Modal.Footer>
			</Modal>
		</>
	)

};