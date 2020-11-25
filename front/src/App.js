import logo from './logo.svg';
import './App.css';
import {BrowserRouter as Router, Link, Redirect, Route, Switch} from "react-router-dom";
import NotesList from "./components/NotesList";
import NotesEdit from "./components/NotesEdit";
import 'bootstrap/dist/css/bootstrap.min.css';
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import React from "react";
import NotesAdd from "./components/NotesAdd";

function App() {
  return (
    <div className="App">
      <Router>
        <Navbar>
          <Navbar.Toggle />
          <Navbar.Collapse className="justify-content-end">
            <Nav className="mr-auto">
              <Link className={'nav-link'} to={`/notes`}>Home</Link>
              <Link className={'nav-link'} to={`/notes/add`}>Add Note</Link>
            </Nav>
          </Navbar.Collapse>
        </Navbar>

        <Switch>
          <Route exact path="/notes" component={NotesList}/>
          <Route exact path="/notes/add" component={NotesAdd}/>
          <Route exact path="/notes/edit/:id" component={NotesEdit}/>
          <Route exact path="/">
            <Redirect to="/notes"/>
          </Route>
        </Switch>
      </Router>
    </div>
  );
}

export default App;
