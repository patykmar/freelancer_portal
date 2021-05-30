import React from "react";
import {Col, Container, Row} from "react-bootstrap";
import {Link, Route, BrowserRouter as Router} from "react-router-dom";
import Invoices from "./components/invoices/Invoices";
import Tariff from "./components/Tariff/Tariff";
import NotBilledWork from "./components/NotBilledWork/NotBilledWork";
import WorkReport from "./components/WorkReport/WorkReport";
import Company from "./components/Company/Company";
import PaymentMethods from "./components/PaymentMethods/PaymentMethods";
import Country from "./components/Country/Country";
import Vat from "./components/Vat/Vat";


class App extends React.Component {

    render() {
        return (
            <Router>
                <Container>
                    <Row>
                        <Col>
                            <ul>
                                <li><Link to={"/"}>Faktury</Link></li>
                            </ul>
                            <ul>
                                <li><Link to={"/tariff"}>Tarif</Link></li>
                                <li><Link to={"/not-billed-work"}>Nevyučtováná práce</Link></li>
                                <li><Link to={"/work-report"}>Pracovní výkaz</Link></li>
                            </ul>
                            <ul>
                                <li><Link to={"/company"}>Firmy</Link></li>
                                <li><Link to={"/payment-methods"}>Platební metody</Link></li>
                                <li><Link to={"/country"}>Zeme</Link></li>
                                <li><Link to={"/vat"}>DPH</Link></li>
                            </ul>
                        </Col>
                        <Col>
                            <main>
                                <Route exact path={"/"} component={Invoices}/>
                                <Route path={"/tariff"} component={Tariff}/>
                                <Route path={"/not-billed-work"} component={NotBilledWork}/>
                                <Route path={"/work-report"} component={WorkReport}/>
                                <Route path={"/company"} component={Company}/>
                                <Route path={"/payment-methods"} component={PaymentMethods}/>
                                <Route path={"/country"} component={Country}/>
                                <Route path={"/vat"} component={Vat}/>
                            </main>
                        </Col>
                    </Row>
                </Container>
            </Router>
        );
    }

}

export default App;
