import React from "react"

export const Navbar = () => {
	return (
		<>
			<header>
				<nav className="navbar navbar-expand-lg navbar-dark bg-dark">
					<a className="navbar-brand" href="#">AbqBike</a>
					<button className="navbar-toggler" type="button" data-toggle="collapse"
							  data-target="#navbarSupportedContent"
							  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span className="navbar-toggler-icon"></span>
					</button>
					<div className="collapse navbar-collapse" id="navbarSupportedContent">
						<ul className="navbar-nav mr-auto">
							<li className="nav-item active">
								<a className="nav-link" href="#">Home <span className="sr-only">(current)</span></a>
							</li>
							<li className="nav-item">
								<a className="nav-link" href="#">Explore</a>
							</li>
							<li className="nav-item">
								<a className="nav-link" href="#">About</a>
							</li>
						</ul>
						<ul className="navbar-nav ml-lg-auto">
							<li className="nav-item dropdown dropleft">
								<a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
									data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									Sign In
								</a>
								<div className="dropdown-menu" aria-labelledby="navbarDropdown">
									<form className="p-4">
										<div className="form-group">
											<label htmlFor="exampleInputEmail1">Email address</label>
											<input type="email" className="form-control" id="exampleInputEmail1"
													 aria-describedby="emailHelp"
													 placeholder="Enter email"/>
												<small id="emailHelp" className="form-text text-muted">We'll never share your email
													with anyone
													else.
												</small>
										</div>
										<div className="form-group">
											<label htmlFor="exampleInputPassword1">Password</label>
											<input type="password" className="form-control" id="exampleInputPassword1"
													 placeholder="Password"/>
										</div>
										<div className="form-group form-check">
											<input type="checkbox" className="form-check-input" id="exampleCheck1"/>
												<label className="form-check-label" htmlFor="exampleCheck1">Check me out</label>
										</div>
										<button type="submit" className="btn btn-primary">Submit</button>
									</form>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</header>


		</>
	)
}
