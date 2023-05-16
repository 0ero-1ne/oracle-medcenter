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



-- DROP TABLE DEPARTMENT_EMPLOYEE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'DEPARTMENT_EMPLOYEE';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE DEPARTMENT_EMPLOYEE';
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

-- DROP TABLESPACES TS_USERS, TS_MEDCENTER
--/
BEGIN
    EXECUTE IMMEDIATE 'DROP TABLESPACE TS_USERS INCLUDING CONTENTS AND DATAFILES CASCADE CONSTRAINTS';
EXCEPTION
    WHEN OTHERS THEN
    IF SQLCODE != -959 THEN
        RAISE;
    END IF;
END;
--/

--/
BEGIN
    EXECUTE IMMEDIATE 'DROP TABLESPACE TS_MEDCENTER INCLUDING CONTENTS AND DATAFILES CASCADE CONSTRAINTS';
EXCEPTION
    WHEN OTHERS THEN
    IF SQLCODE != -959 THEN
        RAISE;
    END IF;
END;
--/

-- CREATING THE MINIMUM REQUIRED NUMBER OF DATABASE OBJECTS
-- FIRST OF ALL, OF COURSE, WE NEED TABLES, THAT DESCRIBE OUR ENTITIES, AND TABLESPACES, THAT WILL STORE OUR TABLES

-- TABLESPACE TS_USERS FOR STORING DATA THAT HAS REFERENCES TO USERS
CREATE TABLESPACE TS_USERS
    DATAFILE 'TS_USERS.dbf'
    SIZE 50M
    AUTOEXTEND ON NEXT 10M
    EXTENT MANAGEMENT LOCAL;

-- TABLESPACE TS_MEDCENTER FOR STORING DATA THAT HAS REFERENCES TO MED STUFF
CREATE TABLESPACE TS_MEDCENTER
    DATAFILE 'TS_MEDCENTER.dbf'
    SIZE 50M
    AUTOEXTEND ON NEXT 10M
    EXTENT MANAGEMENT LOCAL;
    
CREATE TABLE ROLES
(
	role_name NVARCHAR2(64) PRIMARY KEY
) TABLESPACE TS_USERS;

INSERT ALL
    INTO ROLES VALUES ('guest')
	INTO ROLES VALUES ('user') -- PATIENT
	INTO ROLES VALUES ('doctor')
	INTO ROLES VALUES ('manager') -- ADMIN
SELECT 1 FROM DUAL;

CREATE TABLE ADDRESSES
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	region NVARCHAR2(64) NOT NULL,
	town NVARCHAR2(64) NOT NULL,
	street NVARCHAR2(64) NOT NULL,
	house_number NVARCHAR2(10) NOT NULL, -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (80B)
	flat NVARCHAR2(10) -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (301-A)
) TABLESPACE TS_USERS;


CREATE TABLE PASSPORTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    passport_number NVARCHAR2(64) NOT NULL UNIQUE, -- IDENTIFICATION NUMBER
    date_of_issue DATE NOT NULL,
    date_of_expiry DATE NOT NULL,
    authority NVARCHAR2(256) NOT NULL -- THE AUTHORITY THAT ISSUED THE PASSPORT
) TABLESPACE TS_USERS;

CREATE TABLE USERS
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	user_role NVARCHAR2(64) NOT NULL,
	email NVARCHAR2(256) NOT NULL UNIQUE,
	password RAW(32) NOT NULL,
	CONSTRAINT FK_USER_ROLE
		FOREIGN KEY (user_role)
		REFERENCES ROLES (role_name)
) TABLESPACE TS_USERS;

CREATE TABLE PERSONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    first_name NVARCHAR2(64) NOT NULL, -- COLUMN FOR NAME
	second_name NVARCHAR2(64) NOT NULL, -- COLUMN FOR SURNAME
	last_name NVARCHAR2(64), -- COLUMN FOR PATRONOMYC (USUALLY FOR CIS)
	passport_id INTEGER UNIQUE,
	birth_date DATE NOT NULL,
	gender CHAR(1) NOT NULL,
	CONSTRAINT FK_PATIENT_PASSPORT
	   FOREIGN KEY (passport_id)
	   REFERENCES PASSPORTS(id),
	CONSTRAINT CHK_PATIENT_GENDER CHECK (gender IN ('m','f'))
) TABLESPACE TS_USERS;

CREATE TABLE PERSON_ADDRESS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    person_id INTEGER NOT NULL,
    address_id INTEGER NOT NULL,
    CONSTRAINT FK_PERSON_ADDRESS_PERSON
        FOREIGN KEY (person_id)
        REFERENCES PERSONS(id),
    CONSTRAINT FK_PERSON_ADDRESS_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id)
) TABLESPACE TS_USERS;

CREATE TABLE PATIENTS
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	auth_data INTEGER NOT NULL,
	person_id INTEGER NOT NULL,
	phone NVARCHAR2(20) NOT NULL,
	CONSTRAINT FK_PATIENT_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_PATIENT_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE POSITIONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    position_name NVARCHAR2(256),
    position_type NVARCHAR2(20), -- IN THE MEDICAL DEPARTMENT THERE ARE NOT ONLY DOCTORS, BUT ALSO CLEANERS, PROGRAMMERS, ETC.
    CONSTRAINT CHK_POSITION_TYPE CHECK (position_type IN ('doctor', 'head_doctor', 'programmer', 'cleaner', 'security'))
) TABLESPACE TS_MEDCENTER;

CREATE TABLE EMPLOYEES
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    auth_data INTEGER NOT NULL UNIQUE,
    person_id INTEGER NOT NULL UNIQUE,
    position_id INTEGER NOT NULL,
	hire_date DATE NOT NULL,
	education NVARCHAR2(256) NOT NULL,
	phone NVARCHAR2(20) NOT NULL,
	salary NUMBER(10,2) NOT NULL,
	on_vacation CHAR(1) NOT NULL,
	CONSTRAINT FK_EMPLOYEE_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_EMPLOYEE_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id),
	CONSTRAINT FK_EMPLOYEE_POSITION
	   FOREIGN KEY (position_id)
	   REFERENCES POSITIONS(id),
	CONSTRAINT CHK_EMPLOYEE_ONVACATION CHECK (on_vacation in ('0', '1')) -- 0 - not on vacation, 1 - on vacation
) TABLESPACE TS_MEDCENTER;

CREATE TABLE DEPARTMENTS -- FOR EXAMPLE: DENTAL DEPARTMENT, THERAPEUTIC DEPARTMENT, ETC.
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    department_name NVARCHAR2(256) NOT NULL,
    address_id INTEGER NOT NULL,
    department_manager INTEGER, -- EMPLOYEE ID, NULL BECAUSE IT MAY BE BUILDING OR SMTH.
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE
        FOREIGN KEY (department_manager)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_DEPARTMENT_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE DEPARTMENT_EMPLOYEE
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    department_id INTEGER NOT NULL,
    employee_id INTEGER NOT NULL,
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE_DEPARTMENT
        FOREIGN KEY (department_id)
        REFERENCES DEPARTMENTS(id),
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id)
);

CREATE TABLE TALONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    talon_date DATE NOT NULL,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER,
    CONSTRAINT FK_TALON_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TALON_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE SUPPLIERS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    supplier_name NVARCHAR2(256) NOT NULL,
    supplier_country NVARCHAR2(64) NOT NULL
) TABLESPACE TS_MEDCENTER;

CREATE TABLE PHARMACY
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    drug NVARCHAR2(256) NOT NULL,
    price NUMBER(10,2) NOT NULL,
    stock INTEGER NOT NULL,
    need_recipe CHAR(1) NOT NULL,
    supplier_id INTEGER NOT NULL,
    CONSTRAINT FK_DRUG_SUPPLIER
        FOREIGN KEY (supplier_id)
        REFERENCES SUPPLIERS(id),
    CONSTRAINT CHK_NEED_RECIPE CHECK (need_recipe in ('0', '1')) -- 0 - no need in recipe, 1 - need recipe
) TABLESPACE TS_MEDCENTER;

CREATE TABLE PRICELIST
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    position_id INTEGER NOT NULL,
    service NVARCHAR2(256) NOT NULL,
    price NUMBER(10, 2) NOT NULL,
    CONSTRAINT FK_PRICELIST_POSITITON
        FOREIGN KEY (position_id)
        REFERENCES POSITIONS(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE TREATMENTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER NOT NULL,
    start_of_treatment DATE NOT NULL,
    end_of_treatment DATE,
    diagnosis NVARCHAR2(256) NOT NULL,
    treatment_info NVARCHAR2(1024) NOT NULL,
    recommendations NVARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_TREATMENTS_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TREATMENTS_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)    
) TABLESPACE TS_MEDCENTER;

CREATE TABLE COMMENTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    user_id INTEGER NOT NULL,
    employee_id INTEGER NOT NULL,
    comment_text NVARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_COMMENT_USER
        FOREIGN KEY (user_id)
        REFERENCES USERS(id),
    CONSTRAINT FK_COMMENT_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id)
) TABLESPACE TS_MEDCENTER;





-- CRUD PROCEDURES FOR EVERY TABLE

-- ADDRESSES PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_address
(
    p_region in ADDRESSES.region%TYPE,
    p_town in ADDRESSES.town%TYPE,
    p_street in ADDRESSES.street%TYPE,
    p_house_number in ADDRESSES.house_number%TYPE,
    p_flat in ADDRESSES.flat%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_region) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_town) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_street) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_house_number) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_flat) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;

    INSERT INTO ADDRESSES(region, town, street, house_number, flat)
    VALUES (TRIM(p_region), TRIM(p_town), TRIM(p_street), TRIM(p_house_number), TRIM(p_flat));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_address
(
    p_id in ADDRESSES.id%TYPE,
    p_region in ADDRESSES.region%TYPE,
    p_town in ADDRESSES.town%TYPE,
    p_street in ADDRESSES.street%TYPE,
    p_house_number in ADDRESSES.house_number%TYPE,
    p_flat in ADDRESSES.flat%TYPE
)
IS
BEGIN
    UPDATE ADDRESSES
    SET region = nvl(TRIM(p_region), region),
        town = nvl(TRIM(p_town), town),
        street = nvl(TRIM(p_street), street),
        house_number = nvl(TRIM(p_house_number), house_number),
        flat = nvl(TRIM(p_flat), flat)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure_error');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_address
(
    p_id in ADDRESSES.id%TYPE
)
IS
BEGIN
    DELETE FROM ADDRESSES WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure_error');
END;
--/



-- PASSPORTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_passport
(
    p_passport_number in PASSPORTS.passport_number%TYPE,
    p_date_of_issue in VARCHAR2,
    p_date_of_expiry in VARCHAR2,
    p_authority in PASSPORTS.authority%TYPE
)
IS 
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_passport_number) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_date_of_issue) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_date_of_expiry) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    IF TRIM(p_authority) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO PASSPORTS(passport_number, date_of_issue, date_of_expiry, authority)
    VALUES (p_passport_number, to_date(p_date_of_issue, 'dd.mm.yyyy'), to_date(p_date_of_expiry, 'dd.mm.yyyy'), p_authority);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN    
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_passport
(
    p_id in PASSPORTS.id%TYPE,
    p_passport_number in PASSPORTS.passport_number%TYPE,
    p_date_of_issue VARCHAR2,
    p_date_of_expiry VARCHAR2,
    p_authority in PASSPORTS.authority%TYPE
)
IS
BEGIN
    UPDATE PASSPORTS
    SET passport_number = nvl(TRIM(p_passport_number), passport_number),
        date_of_issue = nvl(to_date(TRIM(p_date_of_issue), 'dd.mm.yyyy'), date_of_issue),
        date_of_expiry = nvl(to_date(TRIM(p_date_of_expiry), 'dd.mm.yyyy'), date_of_expiry),
        authority = nvl(TRIM(p_authority), authority)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN    
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_passport
(
    p_id in PASSPORTS.id%TYPE
)
IS
BEGIN
    DELETE FROM PASSPORTS WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN    
        dbms_output.put_line('Procedure error!');
END;
--/



-- USERS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_user
(
    p_user_role in USERS.user_role%TYPE,
    p_email in USERS.email%TYPE,
    p_password in VARCHAR2
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_email) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_password) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO USERS(user_role, email, password)
    VALUES (p_user_role, TRIM(p_email), (select hash_password(TRIM(p_password)) from DUAL));
    COMMIT;
EXCEPTION 
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error');
END;
--/

select * from persons;

--/
CREATE OR REPLACE PROCEDURE update_user
(
    p_id in USERS.id%TYPE,
    p_user_role in USERS.user_role%TYPE,
    p_email in USERS.email%TYPE,
    p_password in VARCHAR2
)
IS
BEGIN
    UPDATE USERS
    SET user_role = NVL(TRIM(p_user_role), user_role),
        email = NVL(TRIM(p_email), email),
        password = NVL(hash_password(TRIM(p_password)),password)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_user
(
    p_id in USERS.id%TYPE
)
IS
BEGIN
    DELETE FROM USERS WHERE id = p_id;
    COMMIT;
END;
--/



-- PERSONS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_person
(
    p_first_name in PERSONS.first_name%TYPE,
    p_second_name in PERSONS.second_name%TYPE,
    p_last_name in PERSONS.last_name%TYPE,
    p_passport_id in PERSONS.passport_id%TYPE,
    p_birth_date VARCHAR2,
    p_gender in PERSONS.gender%TYPE
)
IS 
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_first_name) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_second_name) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_last_name) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_birth_date) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_gender) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO PERSONS(first_name, second_name, last_name, passport_id, birth_date, gender)
    VALUES (TRIM(p_first_name), TRIM(p_second_name), TRIM(p_last_name), p_passport_id, to_date(TRIM(p_birth_date), 'dd.mm.yyyy'), TRIM(p_gender));
    COMMIT;
EXCEPTION 
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_person
(
    p_id in PERSONS.id%TYPE,
    p_first_name in PERSONS.first_name%TYPE,
    p_second_name in PERSONS.second_name%TYPE,
    p_last_name in PERSONS.last_name%TYPE,
    p_passport_id in PERSONS.passport_id%TYPE,
    p_birth_date VARCHAR2,
    p_gender in PERSONS.gender%TYPE
)
IS 
BEGIN
    UPDATE PERSONS
    SET first_name = nvl(TRIM(p_first_name), first_name),
        second_name = nvl(TRIM(p_second_name), second_name),
        last_name = nvl(TRIM(p_last_name), last_name),
        passport_id = nvl(p_passport_id, passport_id),
        birth_date = nvl(to_date(TRIM(p_birth_date), 'dd.mm.yyyy'), birth_date),
        gender = nvl(TRIM(p_gender), gender)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_person
(
    p_id in PERSONS.id%TYPE
)
IS
BEGIN
    DELETE FROM PERSONS WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/



-- PERSON_ADDRESS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_person_address
(
    p_person_id in PERSON_ADDRESS.person_id%TYPE,
    p_address_id in PERSON_ADDRESS.address_id%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_person_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_address_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO PERSON_ADDRESS(person_id, address_id) VALUES (p_person_id, p_address_id);
    COMMIT;
EXCEPTION 
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_person_address
(
    p_id in PERSON_ADDRESS.id%TYPE,
    p_person_id in PERSON_ADDRESS.person_id%TYPE,
    p_address_id in PERSON_ADDRESS.address_id%TYPE
)
IS 
BEGIN
    UPDATE PERSON_ADDRESS
    SET person_id = nvl(p_person_id, person_id),
        address_id = nvl(p_address_id, address_id)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_person_address
(
    p_id in PERSON_ADDRESS.id%TYPE
)
IS 
BEGIN
    DELETE FROM PERSON_ADDRESS WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/



-- PATIENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_patient
(
    p_auth_data in PATIENTS.auth_data%TYPE,
    p_person_id in PATIENTS.person_id%TYPE,
    p_phone in PATIENTS.phone%TYPE
)
IS 
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_auth_data IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_person_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_phone) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO PATIENTS(auth_data, person_id, phone) VALUES (p_auth_data, p_person_id, TRIM(p_phone));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_patient
(
    p_id in PATIENTS.id%TYPE,
    p_auth_data in PATIENTS.auth_data%TYPE,
    p_person_id in PATIENTS.person_id%TYPE,
    p_phone in PATIENTS.phone%TYPE
)
IS
BEGIN
    UPDATE PATIENTS
    SET auth_data = nvl(p_auth_data, auth_data),
        person_id = nvl(p_person_id, person_id),
        phone = nvl(TRIM(p_phone), phone)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_patient
(
    p_id in PATIENTS.id%TYPE
)
IS 
BEGIN
    DELETE FROM PATIENTS WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/



-- EMPLOYEES PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_employee
(
    p_auth_data in EMPLOYEES.auth_data%TYPE,
    p_person_id in EMPLOYEES.person_id%TYPE,
    p_position_id in EMPLOYEES.position_id%TYPE,
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_auth_data IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_person_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_position_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_hire_date IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_education IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_salary IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_phone) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_on_vacation IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO EMPLOYEES(auth_data, person_id, position_id hire_date, education, phone, salary, on_vacation)
    VALUES(p_auth_data, p_person_id, p_position_id, to_date(TRIM(p_hire_date), 'dd.mm.yyyy'), TRIM(p_education), TRIM(p_phone), p_salary, TRIM(p_on_vacation));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_employee
(
    p_id in EMPLOYEES.id%TYPE,
    p_auth_data in EMPLOYEES.auth_data%TYPE,
    p_person_id in EMPLOYEES.person_id%TYPE,
    p_position_id in EMPLOYEES.position_id%TYPE,
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS 
BEGIN
    UPDATE EMPLOYEES
    SET auth_data = nvl(p_auth_data, auth_data),
        person_id = nvl(p_person_id, person_id),
        position_id = nvl(p_position_id, position_id),
        hire_date = nvl(to_date(TRIM(p_hire_date), 'dd.mm.yyyy'), hire_date),
        education = nvl(p_education, education),
        phone = nvl(p_phone, phone),
        salary = nvl(p_salary, salary),
        on_vacation = nvl(TRIM(p_on_vacation), on_vacation)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_employee
(
    p_id in EMPLOYEES.id%TYPE
)
IS 
BEGIN
    DELETE FROM EMPLOYEES WHERE id = p_id;
    COMMIT;
END;
--/



-- DEPARTMENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_department
(
    p_dep_name in DEPARTMENTS.department_name%TYPE,
    p_dep_manager in DEPARTMENTS.department_manager%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_dep_name IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO DEPARTMENTS(department_name, department_manager) VALUES (TRIM(p_dep_name), p_dep_manager);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_department
(
    p_id in DEPARTMENTS.id%TYPE,
    p_dep_name in DEPARTMENTS.department_name%TYPE,
    p_dep_manager in DEPARTMENTS.department_manager%TYPE
)
IS
BEGIN
    UPDATE DEPARTMENTS
    SET department_name = nvl(TRIM(p_dep_name), department_name),
        department_manager = nvl(p_dep_manager, department_manager)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_department
(
    p_id in DEPARTMENTS.id%TYPE
)
IS
BEGIN
    DELETE FROM DEPARTMENTS WHERE id = p_id;
    COMMIT;
END;
--/



-- POSITIONS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_position
(
    p_pos_name in POSITIONS.position_name%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_pos_name IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_pos_type) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO POSITIONS(position_name, position_type)
    VALUES (TRIM(p_pos_name), p_pos_type);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_position
(
    p_id in POSITIONS.id%TYPE,
    p_pos_name in POSITIONS.position_name%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
BEGIN
    UPDATE POSITIONS
    SET position_name = nvl(TRIM(p_pos_name), position_name),
        position_type = nvl(TRIM(p_pos_type), position_type)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_position
(
    p_id in POSITIONS.id%TYPE
)
IS
BEGIN
    DELETE FROM POSITIONS WHERE id = p_id;
    COMMIT;
END;
--/



-- DEPARTMENT_EMPLOYEE PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_department_employee
(
    p_dep_id in DEPARTMENT_EMPLOYEE.department_id%TYPE,
    p_emp_id in DEPARTMENT_EMPLOYEE.employee_id%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_dep_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_emp_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;

    INSERT INTO DEPARTMENT_EMPLOYEE(department_id, employee_id) VALUES (p_dep_id, p_emp_id);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_branch_department
(
    p_id in DEPARTMENT_EMPLOYEE.id%TYPE,
    p_dep_id in DEPARTMENT_EMPLOYEE.department_id%TYPE,
    p_emp_id in DEPARTMENT_EMPLOYEE.employee_id%TYPE
)
IS
BEGIN
    UPDATE DEPARTMENT_EMPLOYEE
    SET employee_id = nvl(p_emp_id, employee_id),
        department_id = nvl(p_dep_id, department_id)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_department_employee
(
    p_id in DEPARTMENT_EMPLOYEE.id%TYPE
)
IS
BEGIN
    DELETE FROM DEPARTMENT_EMPLOYEE WHERE id = p_id;
    COMMIT;
END;
--/



-- TALONS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_talon
(
    p_t_date in VARCHAR2,
    p_emp_id in TALONS.employee_id%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_t_date IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_emp_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO TALONS(talon_date, employee_id, patient_id)
    VALUES (to_date(TRIM(p_t_date), 'DD.MM.YYYY HH24:MI'), p_emp_id, null);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_talon
(
    p_id in TALONS.id%TYPE,
    p_t_date in VARCHAR2,
    p_emp_id in TALONS.employee_id%TYPE,
    p_patient_id in TALONS.patient_id%TYPE
)
IS
BEGIN
    UPDATE TALONS
    SET talon_date = nvl(to_date(TRIM(p_t_date), 'dd.mm.yyyy HH24:MI'), talon_date),
        employee_id = nvl(p_emp_id, employee_id),
        patient_id = nvl(p_patient_id, patient_id)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_talon
(
    p_id in TALONS.id%TYPE
)
IS
BEGIN
    DELETE FROM TALONS WHERE id = p_id;
    COMMIT;
END;
--/



-- SUPPLIERS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_supplier
(
    p_supplier_name in SUPPLIERS.supplier_name%TYPE,
    p_supplier_country in SUPPLIERS.supplier_country%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_supplier_name) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_supplier_country) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO SUPPLIERS(supplier_name, supplier_country)
    VALUES (TRIM(p_supplier_name), TRIM(p_supplier_country));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_supplier
(
    p_id in SUPPLIERS.id%TYPE,
    p_supplier_name in SUPPLIERS.supplier_name%TYPE,
    p_supplier_country in SUPPLIERS.supplier_country%TYPE
)
IS
BEGIN
    UPDATE SUPPLIERS
    SET supplier_name = nvl(TRIM(p_supplier_name), supplier_name),
        supplier_country = nvl(TRIM(p_supplier_country), supplier_country)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_supplier
(
    p_id in SUPPLIERS.id%TYPE
)
IS
BEGIN
    DELETE FROM SUPPLIERS WHERE id = p_id;
    COMMIT;
END;
--/



-- PHARMACY PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_drug
(
    p_drug in PHARMACY.drug%TYPE,
    p_price in PHARMACY.price%TYPE,
    p_stock in  PHARMACY.stock%TYPE,
    p_need_recipe in PHARMACY.need_recipe%TYPE,
    p_supplier_id in PHARMACY.supplier_id%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF TRIM(p_drug) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_price IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_stock IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_need_recipe) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_supplier_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;

    INSERT INTO PHARMACY(drug, price, stock, need_recipe, supplier_id)
    VALUES (TRIM(p_drug), p_price, p_stock, TRIM(p_need_recipe), p_supplier_id);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_drug
(
    p_id in PHARMACY.id%TYPE,
    p_drug in PHARMACY.drug%TYPE,
    p_price in PHARMACY.price%TYPE,
    p_stock in  PHARMACY.stock%TYPE,
    p_need_recipe in PHARMACY.need_recipe%TYPE,
    p_supplier_id in PHARMACY.supplier_id%TYPE
)
IS
BEGIN
    UPDATE PHARMACY
    SET drug = nvl(TRIM(p_drug), drug),
        price = nvl(p_price, price),
        stock = nvl(p_stock, stock),
        need_recipe = nvl(TRIM(p_need_recipe), need_recipe),
        supplier_id = nvl(p_supplier_id, supplier_id)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_drug
(
    p_id in PHARMACY.id%TYPE
)
IS
BEGIN
    DELETE FROM PHARMACY WHERE id = p_id;
    COMMIT;
END;
--/



-- COMMENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_comment
(
    p_user_id in COMMENTS.user_id%TYPE,
    p_employee_id in COMMENTS.employee_id%TYPE,
    p_comment_text in COMMENTS.comment_text%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_user_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_employee_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_comment_text) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO COMMENTS(user_id, employee_id, comment_text)
    VALUES (p_user_id, p_employee_id, TRIM(p_comment_text));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_comment
(
    p_id in COMMENTS.id%TYPE,
    p_user_id in COMMENTS.user_id%TYPE,
    p_employee_id in COMMENTS.employee_id%TYPE,
    p_comment_text in COMMENTS.comment_text%TYPE
)
IS
BEGIN
    UPDATE COMMENTS
    SET user_id = nvl(p_user_id, user_id),
        employee_id = nvl(p_employee_id, employee_id),
        comment_text = nvl(TRIM(p_comment_text), comment_text)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_comment
(
    p_id in COMMENTS.id%TYPE
)
IS
BEGIN
    DELETE FROM COMMENTS WHERE id = p_id;
    COMMIT;
END;
--/



-- PRICELIST PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_listitem
(
    p_pos_id in PRICELIST.position_id%TYPE,
    p_service in PRICELIST.service%TYPE,
    p_price in PRICELIST.price%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_pos_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_service) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_price IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;

    INSERT INTO PRICELIST(position_id, service, price)
    VALUES (p_pos_id, TRIM(p_service), p_price);
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_listitem
(
    p_id in PHARMACY.id%TYPE,
    p_pos_id in PRICELIST.position_id%TYPE,
    p_service in PRICELIST.service%TYPE,
    p_price in PRICELIST.price%TYPE
)
IS
BEGIN
    UPDATE PRICELIST
    SET position_id = nvl(p_pos_id, position_id),
        service = nvl(TRIM(p_service), service),
        price = nvl(p_price, price)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_listitem
(
    p_id in PRICELIST.id%TYPE
)
IS
BEGIN
    DELETE FROM PRICELIST WHERE id = p_id;
    COMMIT;
END;
--/



-- TREATMENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_treatment
(
    p_emp_id in TREATMENTS.employee_id%TYPE,
    p_patient_id in TREATMENTS.patient_id%TYPE,
    p_start in VARCHAR2,
    p_diagnosis in TREATMENTS.diagnosis%TYPE,
    p_info in TREATMENTS.treatment_info%TYPE,
    p_recomms in TREATMENTS.recommendations%TYPE
)
IS
    empty_parameter_ex EXCEPTION;
BEGIN
    IF p_emp_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF p_patient_id IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_start) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_diagnosis) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_info) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    IF TRIM(p_recomms) IS NULL THEN
        RAISE empty_parameter_ex;
    END IF;
    
    INSERT INTO TREATMENTS(employee_id, patient_id, start_of_treatment, end_of_treatment, diagnosis, treatment_info, recommendations)
    VALUES (p_emp_id, p_patient_id, to_date(TRIM(p_start), 'dd.mm.yyyy hh24:mi'), null, TRIM(p_diagnosis), TRIM(p_info), TRIM(p_recomms));
    COMMIT;
EXCEPTION
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_treatment
(
    p_id in TREATMENTS.id%TYPE,
    p_emp_id in TREATMENTS.employee_id%TYPE,
    p_patient_id in TREATMENTS.patient_id%TYPE,
    p_start in VARCHAR2,
    p_end in VARCHAR2,
    p_diagnosis in TREATMENTS.diagnosis%TYPE,
    p_info in TREATMENTS.treatment_info%TYPE,
    p_recomms in TREATMENTS.recommendations%TYPE
)
IS
BEGIN
    UPDATE TREATMENTS
    SET employee_id = nvl(p_emp_id, employee_id),
        patient_id = nvl(p_patient_id, patient_id),
        start_of_treatment = nvl(to_date(TRIM(p_start), 'dd.mm.yyyy hh24:mi'), start_of_treatment),
        end_of_treatment = nvl(to_date(TRIM(p_end), 'dd.mm.yyyy hh24:mi'), end_of_treatment),
        diagnosis = nvl(TRIM(p_diagnosis), diagnosis),
        treatment_info = nvl(TRIM(p_info), treatment_info),
        recommendations = nvl(TRIM(p_recomms), recommendations)
    WHERE id = p_id;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
        dbms_output.put_line('Procedure error! Check you parameters');
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_treatment
(
    p_id in TREATMENTS.id%TYPE
)
IS
BEGIN
    DELETE FROM TREATMENTS WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE FUNCTION hash_password(f_password IN varchar2)
    RETURN RAW
AS
BEGIN
    IF f_password IS NULL
    THEN
        RETURN NULL;
    ELSE
        RETURN sys.dbms_crypto.hash(utl_raw.cast_to_raw(f_password), sys.dbms_crypto.hash_sh256);
    END IF;
END;
--/

--/
CREATE OR REPLACE FUNCTION compare_passwords
(
    user_id in USERS.id%TYPE,
    password in VARCHAR2
)
RETURN NUMBER
IS
    hash RAW(32);
    user_password RAW(32);
BEGIN
    SELECT password INTO user_password FROM USERS WHERE id = user_id;

    hash := hash_password(TRIM(password));
    RETURN DBMS_LOB.compare(hash, user_password);
END;
--/
