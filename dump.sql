-- ALL SCRIPT WAS CREATED IN DbVisualizer
-- FOR PL/SQL SCRIPTS WHERE ADDED '--/' CHARS BEFORE AND AFTER STATEMENT - JUST FOR CORRECT RUNNING OF SCRIPT

-- PREPARING THE DATABASE TO CREATE THE NECESSARY OBJECTS
-- AT FIRST DROP ALL TABLES WITH THE SAME NAME


-- DROP TABLE PHARMACY
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PHARMACY';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PHARMACY';
    END IF;
END;
--/


-- DROP TABLE SUPPLIERS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'SUPPLIERS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE SUPPLIERS';
    END IF;
END;
--/


-- DROP TABLE COMMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'COMMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE COMMENTS';
    END IF;
END;
--/


-- DROP TABLE TREATMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'TREATMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE TREATMENTS';
    END IF;
END;
--/


-- DROP TABLE PRICELIST
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PRICELIST';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PRICELIST';
    END IF;
END;
--/


-- DROP TABLE EMPLOYEE_POSITION
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'EMPLOYEE_POSITION';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE EMPLOYEE_POSITION';
    END IF;
END;
--/


-- DROP TABLE POSITIONS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'POSITIONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE POSITIONS';
    END IF;
END;
--/


-- DROP BRANCH_DEPARTMENT TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'BRANCH_DEPARTMENT';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE BRANCH_DEPARTMENT';
    END IF;
END;
--/


-- DROP BRANCHES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'BRANCHES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE BRANCHES';
    END IF;
END;
--/


-- DROP TABLE DEPARTMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'DEPARTMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE DEPARTMENTS';
    END IF;
END;
--/


-- DROP TABLE TALONS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'TALONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE TALONS';
    END IF;
END;
--/


-- DROP TABLE PATIENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PATIENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PATIENTS';
    END IF;
END;
--/


-- DROP TABLE EMPLOYEES
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'EMPLOYEES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE EMPLOYEES';
    END IF;
END;
--/


-- DROP PERSON_ADDRESS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PERSON_ADDRESS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PERSON_ADDRESS';
    END IF;
END;
--/


-- DROP PERSONS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PERSONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PERSONS';
    END IF;
END;
--/


-- DROP ADDRESSES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'ADDRESSES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE ADDRESSES';
    END IF;
END;
--/


-- DROP TABLE PASSPORTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PASSPORTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PASSPORTS';
    END IF;
END;
--/


-- DROP USERS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'USERS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE USERS';
    END IF;
END;
--/


-- DROP ROLES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'ROLES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE ROLES';
    END IF;
END;
--/





-- CREATING THE MINIMUM REQUIRED NUMBER OF DATABASE OBJECTS
-- FIRST OF ALL, OF COURSE, WE NEED TABLES, THAT DESCRIBE OUR ENTITIES


CREATE TABLE ROLES
(
	role_name VARCHAR2(64) PRIMARY KEY
);

INSERT ALL
	INTO ROLES VALUES ('user') -- PATIENT
	INTO ROLES VALUES ('employee')
	INTO ROLES VALUES ('manager') -- ADMIN
SELECT 1 FROM DUAL;


--/
CREATE OR REPLACE PROCEDURE add_role
(
    X VARCHAR2
)
IS
BEGIN
    INSERT INTO ROLES VALUES(X);  
END;
--/

CREATE TABLE ADDRESSES
(
	id INTEGER PRIMARY KEY,
	region VARCHAR2(64) NOT NULL,
	town VARCHAR2(64) NOT NULL,
	street VARCHAR2(64) NOT NULL,
	house_number VARCHAR2(10) NOT NULL, -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (80B)
	flat VARCHAR2(10) -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (301-A)
);

CREATE TABLE PASSPORTS
(
    id VARCHAR2(64) PRIMARY KEY, -- IDENTIFICATION NUMBER
    passport_number VARCHAR2(64) NOT NULL,
    date_of_issue DATE NOT NULL,
    date_of_expiry DATE NOT NULL,
    authority VARCHAR2(256) NOT NULL -- THE AUTHORITY THAT ISSUED THE PASSPORT
);

CREATE TABLE USERS
(
	id INTEGER PRIMARY KEY,
	user_role VARCHAR2(64) NOT NULL,
	email VARCHAR2(256) NOT NULL UNIQUE,
	password VARCHAR2(256) NOT NULL,
	CONSTRAINT FK_USER_ROLE
		FOREIGN KEY (user_role)
		REFERENCES ROLES (role_name)
);

CREATE TABLE PERSONS
(
    id INTEGER PRIMARY KEY,
    first_name VARCHAR2(64) NOT NULL, -- COLUMN FOR NAME
	second_name VARCHAR2(64) NOT NULL, -- COLUMN FOR SURNAME
	last_name VARCHAR2(64), -- COLUMN FOR PATRONOMYC (USUALLY FOR CIS)
	passport_id VARCHAR2(64),
	birth_date DATE NOT NULL,
	gender CHAR(1) NOT NULL,
	CONSTRAINT FK_PATIENT_PASSPORT
	   FOREIGN KEY (passport_id)
	   REFERENCES PASSPORTS(id),
	CONSTRAINT CHK_PATIENT_GENDER CHECK (gender IN ('m','f'))
);

CREATE TABLE PERSON_ADDRESS
(
    id INTEGER PRIMARY KEY,
    person_id INTEGER NOT NULL,
    address_id INTEGER NOT NULL,
    CONSTRAINT FK_PERSON_ADDRESS_PERSON
        FOREIGN KEY (person_id)
        REFERENCES PERSONS(id),
    CONSTRAINT FK_PERSON_ADDRESS_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id)
);

CREATE TABLE PATIENTS
(
	id INTEGER PRIMARY KEY,
	auth_data INTEGER NOT NULL,
	person_id INTEGER NOT NULL,
	phone VARCHAR2(20) NOT NULL,
	CONSTRAINT FK_PATIENT_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_PATIENT_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id)
);

CREATE TABLE EMPLOYEES
(
    id INTEGER PRIMARY KEY,
    auth_data INTEGER NOT NULL,
    person_id INTEGER NOT NULL,
	hire_date DATE NOT NULL,
	education VARCHAR2(256) NOT NULL,
	phone VARCHAR2(20) NOT NULL,
	salary INTEGER NOT NULL,
	on_vacation CHAR(1) NOT NULL,
	CONSTRAINT FK_EMPLOYEE_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_EMPLOYEE_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id),
	CONSTRAINT CHK_EMPLOYEE_ONVACATION CHECK (on_vacation in ('0', '1')) -- 0 - not on vacation, 1 - on vacation
);

CREATE TABLE DEPARTMENTS -- FOR EXAMPLE: DENTAL DEPARTMENT, THERAPEUTIC DEPARTMENT, ETC.
(
    department_name VARCHAR2(256) PRIMARY KEY,
    department_manager INTEGER, -- EMPLOYEE ID
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE
        FOREIGN KEY (department_manager)
        REFERENCES EMPLOYEES(id)
);

CREATE TABLE POSITIONS
(
    position_name VARCHAR2(256) PRIMARY KEY,
    department_name VARCHAR2(256) NOT NULL,
    position_type VARCHAR2(20), -- IN THE MEDICAL DEPARTMENT THERE ARE NOT ONLY DOCTORS, BUT ALSO CLEANERS, PROGRAMMERS, ETC.
    CONSTRAINT CHK_POSITION_TYPE CHECK (position_type IN ('doctor', 'head_doctor', 'programmer', 'cleaner', 'security')),
    CONSTRAINT FK_POSITION_DEPARTMENT
        FOREIGN KEY (department_name)
        REFERENCES DEPARTMENTS(department_name)
);

CREATE TABLE BRANCHES
(
    id INTEGER PRIMARY KEY,
    address_id INTEGER NOT NULL,
    branch_manager INTEGER NOT NULL,
    CONSTRAINT FK_BRANCH_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id),
    CONSTRAINT FK_BRANCH_MANAGER
        FOREIGN KEY (branch_manager)
        REFERENCES EMPLOYEES(id)
);

CREATE TABLE BRANCH_DEPARTMENT
(
    id INTEGER PRIMARY KEY,
    branch_id INTEGER NOT NULL,
    department_name VARCHAR2(256) NOT NULL,
    CONSTRAINT FK_BRANCH_DEPARTMENT_BRANCH
        FOREIGN KEY (branch_id)
        REFERENCES BRANCHES(id),
    CONSTRAINT FK_BRANCH_DEPARTMENT_DEPARTMENT
        FOREIGN KEY (department_name)
        REFERENCES DEPARTMENTS(department_name)    
);

CREATE TABLE EMPLOYEE_POSITION
(
    id INTEGER PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    position_name VARCHAR2(256) NOT NULL,
    CONSTRAINT FK_EMPLOYEE_POSITION_EMPLOYEE_ID
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_EMPLOYEE_POSITION_POSITION_NAME
        FOREIGN KEY (position_name)
        REFERENCES POSITIONS(position_name)
);

CREATE TABLE TALONS
(
    id INTEGER PRIMARY KEY,
    talon_date DATE NOT NULL,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER,
    CONSTRAINT FK_TALON_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TALON_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)
);

CREATE TABLE SUPPLIERS
(
    id INTEGER PRIMARY KEY,
    supplier_name VARCHAR2(256) NOT NULL,
    supplier_country VARCHAR2(64) NOT NULL
);

CREATE TABLE PHARMACY
(
    id INTEGER PRIMARY KEY,
    drug VARCHAR2(256) NOT NULL,
    price INTEGER NOT NULL,
    stock INTEGER NOT NULL,
    need_recipe CHAR(1) NOT NULL,
    supplier INTEGER NOT NULL,
    CONSTRAINT FK_DRUG_SUPPLIER
        FOREIGN KEY (supplier)
        REFERENCES SUPPLIERS(id),
    CONSTRAINT CHK_NEED_RECIPE CHECK (need_recipe in ('0', '1')) -- 0 - no need in recipe, 1 - need recipe
);

CREATE TABLE PRICELIST
(
    id INTEGER PRIMARY KEY,
    position_name VARCHAR2(256) NOT NULL,
    service VARCHAR2(256) NOT NULL,
    price NUMBER(10, 2) NOT NULL,
    CONSTRAINT FK_PRICELIST_POSITITON
        FOREIGN KEY (position_name)
        REFERENCES POSITIONS(position_name)
);

CREATE TABLE TREATMENTS
(
    id INTEGER PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER NOT NULL,
    start_of_tratment DATE NOT NULL,
    end_of_treatment DATE,
    diagnosis VARCHAR2(256) NOT NULL,
    treatment_info VARCHAR2(1024) NOT NULL,
    recommendations VARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_TREATMENTS_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TREATMENTS_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)    
);

CREATE TABLE COMMENTS
(
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    employee_id INTEGER NOT NULL,
    comment_text VARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_COMMENT_USER
        FOREIGN KEY (user_id)
        REFERENCES USERS(id),
    CONSTRAINT FK_COMMENT_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id)
);






