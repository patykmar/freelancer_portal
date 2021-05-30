import React from "react";
import axios from "axios";
import SimpleForm from "../SimpleForm/SimpleForm";



class Company extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            companies: []
        };
    }

    componentDidMount() {
        axios.get(`http://localhost:8000/api/companies`)
            .then(res => {
                this.setState({companies: res.data});
                console.log("Company - Axios get data");
                console.log(this.state.companies);
            })
    }

    render() {
        return (
            <>
                <h1>Company</h1>
                <SimpleForm/>

            </>
        );
    }
}

export default Company;