CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  phone VARCHAR(20),
  role VARCHAR(20) DEFAULT 'client',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE providers (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  specialty VARCHAR(100),
  available_hours TEXT,
  location VARCHAR(255),
  phone VARCHAR(20)
);

CREATE TABLE services (
  id SERIAL PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  duration INTEGER, -- in minutes
  price DECIMAL(10, 2)
);

CREATE TABLE appointments (
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES users(id),
  provider_id INTEGER REFERENCES providers(id),
  appointment_time TIMESTAMP NOT NULL,
  status VARCHAR(20) DEFAULT 'pending',
  notes TEXT
);

CREATE TABLE appointment_services (
  appointment_id INTEGER REFERENCES appointments(id),
  service_id INTEGER REFERENCES services(id),
  PRIMARY KEY (appointment_id, service_id)
);

CREATE TABLE timeslots (
  id SERIAL PRIMARY KEY,
  provider_id INTEGER REFERENCES providers(id),
  start_time TIMESTAMP NOT NULL,
  end_time TIMESTAMP NOT NULL,
  is_booked BOOLEAN DEFAULT FALSE
);
