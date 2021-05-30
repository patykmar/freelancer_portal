import React from "react";
import {Form, FormText} from "react-bootstrap";

class SimpleForm extends React.Component {


    render() {
        return (
            <Form>
                <Form.Group controlId="exampleForm.ControlInput1">
                    <Form.Label>Name</Form.Label>
                    <Form.Control type="text" />
                </Form.Group>
            </Form>
        );
    }
}

export default SimpleForm;