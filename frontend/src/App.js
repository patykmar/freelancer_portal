import React from "react";

class App extends React.Component {

    render() {
        return (
            <div className="App">
                <header className="App-header">
                    <p>Hello</p>
                </header>
                <main>
                    <ul>
                        <li>Faktury</li>
                    </ul>
                    <ul>
                        <li>Tarif</li>
                        <li>Nevyfakturovana prace</li>
                        <li>Pracovni vykaz</li>
                    </ul>
                    <ul>
                        <li>Firmy</li>
                        <li>Platebni metody</li>
                        <li>Zeme</li>
                        <li>DPH</li>
                    </ul>
                </main>
            </div>
        );
    }

}

export default App;
