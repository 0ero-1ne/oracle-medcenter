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
	passport_id INTEGER,
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

CREATE TABLE EMPLOYEES
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    auth_data INTEGER NOT NULL,
    person_id INTEGER NOT NULL,
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
	CONSTRAINT CHK_EMPLOYEE_ONVACATION CHECK (on_vacation in ('0', '1')) -- 0 - not on vacation, 1 - on vacation
) TABLESPACE TS_MEDCENTER;

CREATE TABLE DEPARTMENTS -- FOR EXAMPLE: DENTAL DEPARTMENT, THERAPEUTIC DEPARTMENT, ETC.
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    department_name NVARCHAR2(256) NOT NULL,
    department_manager INTEGER NOT NULL, -- EMPLOYEE ID
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE
        FOREIGN KEY (department_manager)
        REFERENCES EMPLOYEES(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE POSITIONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    position_name NVARCHAR2(256),
    department_id INTEGER NOT NULL,
    position_type NVARCHAR2(20), -- IN THE MEDICAL DEPARTMENT THERE ARE NOT ONLY DOCTORS, BUT ALSO CLEANERS, PROGRAMMERS, ETC.
    CONSTRAINT CHK_POSITION_TYPE CHECK (position_type IN ('doctor', 'head_doctor', 'programmer', 'cleaner', 'security')),
    CONSTRAINT FK_POSITION_DEPARTMENT
        FOREIGN KEY (department_id)
        REFERENCES DEPARTMENTS(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE BRANCHES
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    address_id INTEGER NOT NULL,
    branch_manager INTEGER NOT NULL,
    CONSTRAINT FK_BRANCH_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id),
    CONSTRAINT FK_BRANCH_MANAGER
        FOREIGN KEY (branch_manager)
        REFERENCES EMPLOYEES(id)
) TABLESPACE TS_MEDCENTER;

CREATE TABLE BRANCH_DEPARTMENT
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    branch_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    CONSTRAINT FK_BRANCH_DEPARTMENT_BRANCH
        FOREIGN KEY (branch_id)
        REFERENCES BRANCHES(id),
    CONSTRAINT FK_BRANCH_DEPARTMENT_DEPARTMENT
        FOREIGN KEY (department_id)
        REFERENCES DEPARTMENTS(id)    
) TABLESPACE TS_MEDCENTER;

CREATE TABLE EMPLOYEE_POSITION
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    position_id INTEGER NOT NULL,
    CONSTRAINT FK_EMPLOYEE_POSITION_EMPLOYEE_ID
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_EMPLOYEE_POSITION_POSITION_NAME
        FOREIGN KEY (position_id)
        REFERENCES POSITIONS(id)
) TABLESPACE TS_MEDCENTER;

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
    SET region = (select nvl2(p_region, p_region, (select region from addresses where id = p_id)) from dual),
        town = (select nvl2(p_town, p_town, (select town from addresses where id = p_id)) from dual),
        street = (select nvl2(p_street, p_street, (select street from addresses where id = p_id)) from dual),
        house_number = (select nvl2(p_house_number, p_house_number, (select house_number from addresses where id = p_id)) from dual),
        flat = (select nvl2(p_flat, p_flat, (select flat from addresses where id = p_id)) from dual)
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
BEGIN
    create_passport('12345', '18.02.2023', '18.02.2033', '12345');
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
    SET passport_number = (select nvl2(p_passport_number, TRIM(p_passport_number), (select passport_number from passports where id = p_id)) from dual),
        date_of_issue = (select nvl2(p_date_of_issue, to_date(p_date_of_issue, 'dd.mm.yyyy'), (select date_of_issue from passports where id = p_id)) from dual),
        date_of_expiry = (select nvl2(p_date_of_expiry, to_date(p_date_of_expiry, 'dd.mm.yyyy'), (select date_of_expiry from passports where id = p_id)) from dual),
        authority = (select nvl2(p_authority, TRIM(p_authority), (select authority from passports where id = p_id)) from dual)
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
    p_password in CLOB
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

--/
CREATE OR REPLACE PROCEDURE update_user
(
    p_id in USERS.id%TYPE,
    p_user_role in USERS.user_role%TYPE,
    p_email in USERS.email%TYPE,
    p_password in CLOB
)
IS
    empty_parameter_ex EXCEPTION;
    new_password RAW(32);
BEGIN
    select password into new_password from users where id = p_id;
    
    IF p_password IS NOT NULL
    THEN
        select hash_password(p_password) into new_password from dual;
    END IF;

    UPDATE USERS
    SET user_role = (select nvl2(p_user_role, p_user_role, (select user_role from users where id = p_id)) from dual),
        email = (select nvl2(p_email, TRIM(p_email), (select email from users where id = p_id)) from dual),
        password = new_password
    WHERE id = p_id;
    COMMIT;
EXCEPTION 
    WHEN empty_parameter_ex THEN
        dbms_output.put_line('Empty parameter');
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
    VALUES (TRIM(p_first_name), TRIM(p_second_name), TRIM(p_last_name), p_passport_id, to_date(p_birth_date, 'dd.mm.yyyy'), p_gender);
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
    SET first_name = (select nvl2(p_first_name, TRIM(p_first_name), (select first_name from persons where id = p_id)) from dual),
        second_name = (select nvl2(p_second_name, TRIM(p_second_name), (select second_name from persons where id = p_id)) from dual),
        last_name = (select nvl2(p_last_name, TRIM(p_last_name), (select last_name from persons where id = p_id)) from dual),
        passport_id = (select nvl2(p_passport_id, p_passport_id, (select passport_id from persons where id = p_id)) from dual),
        birth_date = (select nvl2(p_birth_date, to_date(p_birth_date, 'dd.mm.yyyy'), (select birth_date from persons where id = p_id)) from dual),
        gender = (select nvl2(p_gender, p_gender, (select gender from persons where id = p_id)) from dual)
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
    SET person_id = (select nvl2(p_person_id, p_person_id, (select person_id from person_address where id = p_id)) from dual),
        address_id = (select nvl2(p_address_id, p_address_id, (select address_id from person_address where id = p_id)) from dual)
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
    SET auth_data = (select nvl2(p_auth_data, p_auth_data, (select auth_data from patients where id = p_id)) from dual),
        person_id = (select nvl2(p_person_id, p_person_id, (select person_id from patients where id = p_id)) from dual),
        phone = (select nvl2(p_phone, TRIM(p_phone), (select phone from patients where id = p_id)) from dual)
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
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS 
BEGIN
    INSERT INTO EMPLOYEES(auth_data, person_id, hire_date, education, phone, salary, on_vacation)
    VALUES(p_auth_data, p_person_id, to_date(p_hire_date, 'dd.mm.yyyy'), p_education, p_phone, p_salary, p_on_vacation);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_employee
(
    p_id in EMPLOYEES.id%TYPE,
    p_auth_data in EMPLOYEES.auth_data%TYPE,
    p_person_id in EMPLOYEES.person_id%TYPE,
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS 
BEGIN
    UPDATE EMPLOYEES
    SET auth_data = (select nvl2(p_auth_data, p_auth_data, (select auth_data from employees where id = p_id)) from dual),
        person_id = (select nvl2(p_person_id, p_person_id, (select person_id from employees where id = p_id)) from dual),
        hire_date = (select nvl2(p_hire_date, to_date(p_hire_date, 'dd.mm.yyyy'), (select hire_date from employees where id = p_id)) from dual),
        education = (select nvl2(p_education, p_education, (select education from employees where id = p_id)) from dual),
        phone = (select nvl2(p_phone, p_phone, (select phone from employees where id = p_id)) from dual),
        salary = (select nvl2(p_salary, p_salary, (select salary from employees where id = p_id)) from dual),
        on_vacation = (select nvl2(p_on_vacation, p_on_vacation, (select on_vacation from employees where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO DEPARTMENTS(department_name, department_manager) VALUES (p_dep_name, p_dep_manager);
    COMMIT;
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
    SET department_name = (select nvl2(p_dep_name, p_dep_name, (select department_name from departments where id = p_id)) from dual),
        department_manager = (select nvl2(p_dep_manager, p_dep_manager, (select department_manager from departments where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
    p_dep_id in POSITIONS.department_id%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
BEGIN
    INSERT INTO POSITIONS(position_name, department_id, position_type)
    VALUES (p_pos_name, p_dep_id, p_pos_type);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_position
(
    p_id in POSITIONS.id%TYPE,
    p_pos_name in POSITIONS.position_name%TYPE,
    p_dep_id in POSITIONS.department_id%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
BEGIN
    UPDATE POSITIONS
    SET position_name = (select nvl2(p_pos_name, p_pos_name, (select position_name from positions where id = p_id)) from dual),
        department_id = (select nvl2(p_dep_id, p_dep_id, (select department_id from positions where id = p_id)) from dual),
        position_type = (select nvl2(p_pos_type, p_pos_type, (select position_type from positions where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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



-- BRANCHES PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_branch
(
    p_addr_id in BRANCHES.address_id%TYPE,
    p_br_manager in BRANCHES.branch_manager%TYPE
)
IS
BEGIN
    INSERT INTO BRANCHES(address_id, branch_manager) VALUES (p_addr_id, p_br_manager);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_branch
(
    p_id in BRANCHES.id%TYPE,
    p_addr_id in BRANCHES.address_id%TYPE,
    p_br_manager in BRANCHES.branch_manager%TYPE
)
IS
BEGIN
    UPDATE BRANCHES
    SET address_id = (select nvl2(p_addr_id, p_addr_id, (select address_id from branches where id = p_id)) from dual),
        branch_manager = (select nvl2(p_br_manager, p_br_manager, (select branch_manager from branches where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_branch
(
    p_id in BRANCHES.id%TYPE
)
IS
BEGIN
    DELETE FROM BRANCHES WHERE id = p_id;
    COMMIT;
END;
--/



-- BRANCH_DEPARTMENT PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_branch_department
(
    p_br_id in BRANCH_DEPARTMENT.branch_id%TYPE,
    p_dep_id in BRANCH_DEPARTMENT.department_id%TYPE
)
IS
BEGIN
    INSERT INTO BRANCH_DEPARTMENT(branch_id, department_id) VALUES (p_br_id, p_dep_id);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_branch_department
(
    p_id in BRANCH_DEPARTMENT.id%TYPE,
    p_br_id in BRANCH_DEPARTMENT.branch_id%TYPE,
    p_dep_id in BRANCH_DEPARTMENT.department_id%TYPE
)
IS
BEGIN
    UPDATE BRANCH_DEPARTMENT
    SET branch_id = (select nvl2(p_br_id, p_br_id, (select branch_id from branch_department where id = p_id)) from dual),
        department_id = (select nvl2(p_dep_id, p_dep_id, (select department_id from branch_department where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_branch_department
(
    p_id in BRANCH_DEPARTMENT.id%TYPE
)
IS
BEGIN
    DELETE FROM BRANCH_DEPARTMENT WHERE id = p_id;
    COMMIT;
END;
--/



-- EMPLOYEE_POSITION PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_employee_position
(
    p_emp_id in EMPLOYEE_POSITION.employee_id%TYPE,
    p_pos_id in EMPLOYEE_POSITION.position_id%TYPE
)
IS
BEGIN
    INSERT INTO EMPLOYEE_POSITION(employee_id, position_id) VALUES (p_emp_id, p_pos_id);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_employee_position
(
    p_id in EMPLOYEE_POSITION.id%TYPE,
    p_emp_id in EMPLOYEE_POSITION.employee_id%TYPE,
    p_pos_id in EMPLOYEE_POSITION.position_id%TYPE
)
IS
BEGIN
    UPDATE EMPLOYEE_POSITION
    SET employee_id = (select nvl2(p_emp_id, p_emp_id, (select employee_id from employee_position where id = p_id)) from dual),
        position_id = (select nvl2(p_pos_id, p_pos_id, (select position_id from employee_position where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_employee_position
(
    p_id in EMPLOYEE_POSITION.id%TYPE
)
IS
BEGIN
    DELETE FROM EMPLOYEE_POSITION WHERE id = p_id;
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
BEGIN
    INSERT INTO TALONS(talon_date, employee_id, patient_id)
    VALUES (to_date(p_t_date, 'DD.MM.YYYY HH24:MI'), p_emp_id, null);
    COMMIT;
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
    SET talon_date = (select nvl2(p_t_date, to_date(p_t_date, 'dd.mm.yyyy HH24:MI'), (select talon_date from talons where id = p_id)) from dual),
        employee_id = (select nvl2(p_emp_id, p_emp_id, (select employee_id from talons where id = p_id)) from dual),
        patient_id = (select nvl2(p_patient_id, p_patient_id, (select patient_id from talons where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO SUPPLIERS(supplier_name, supplier_country)
    VALUES (p_supplier_name, p_supplier_country);
    COMMIT;
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
    SET supplier_name = (select nvl2(p_supplier_name, p_supplier_name, (select supplier_name from suppliers where id = p_id)) from dual),
        supplier_country = (select nvl2(p_supplier_country, p_supplier_country, (select supplier_country from suppliers where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO PHARMACY(drug, price, stock, need_recipe, supplier_id)
    VALUES (p_drug, p_price, p_stock, p_need_recipe, p_supplier_id);
    COMMIT;
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
    SET drug = (select nvl2(p_drug, p_drug, (select drug from pharmacy where id = p_id)) from dual),
        price = (select nvl2(p_price, p_price, (select price from pharmacy where id = p_id)) from dual),
        stock = (select nvl2(p_stock, p_stock, (select stock from pharmacy where id = p_id)) from dual),
        need_recipe = (select nvl2(p_need_recipe, p_need_recipe, (select need_recipe from pharmacy where id = p_id)) from dual),
        supplier_id = (select nvl2(p_supplier_id, p_supplier_id, (select supplier_id from pharmacy where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO COMMENTS(user_id, employee_id, comment_text)
    VALUES (p_user_id, p_employee_id, p_comment_text);
    COMMIT;
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
    SET user_id = (select nvl2(p_user_id, p_user_id, (select user_id from comments where id = p_id)) from dual),
        employee_id = (select nvl2(p_employee_id, p_employee_id, (select employee_id from comments where id = p_id)) from dual),
        comment_text = (select nvl2(p_comment_text, p_comment_text, (select comment_text from comments where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO PRICELIST(position_id, service, price)
    VALUES (p_pos_id, p_service, p_price);
    COMMIT;
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
    SET position_id = (select nvl2(p_pos_id, p_pos_id, (select position_id from pricelist where id = p_id)) from dual),
        service = (select nvl2(p_service, p_service, (select service from pricelist where id = p_id)) from dual),
        price = (select nvl2(p_price, p_price, (select price from pricelist where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
BEGIN
    INSERT INTO TREATMENTS(employee_id, patient_id, start_of_treatment, end_of_treatment, diagnosis, treatment_info, recommendations)
    VALUES (p_emp_id, p_patient_id, to_date(p_start, 'dd.mm.yyyy hh24:mi'), null, p_diagnosis, p_info, p_recomms);
    COMMIT;
END;
--/

select * from treatments;

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
    SET employee_id = (select nvl2(p_emp_id, p_emp_id, (select employee_id from treatments where id = p_id)) from dual),
        patient_id = (select nvl2(p_patient_id, p_patient_id, (select patient_id from treatments where id = p_id)) from dual),
        start_of_treatment = (select nvl2(p_start, to_date(p_start, 'dd.mm.yyyy hh24:mi'), (select start_of_treatment from treatments where id = p_id)) from dual),
        end_of_treatment = (select nvl2(p_end, to_date(p_end, 'dd.mm.yyyy hh24:mi'), (select end_of_treatment from treatments where id = p_id)) from dual),
        diagnosis = (select nvl2(p_diagnosis, p_diagnosis, (select diagnosis from treatments where id = p_id)) from dual),
        treatment_info = (select nvl2(p_info, p_info, (select treatment_info from treatments where id = p_id)) from dual),
        recommendations = (select nvl2(p_recomms, p_recomms, (select recommendations from treatments where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
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
CREATE OR REPLACE FUNCTION hash_password
(
    f_password IN CLOB
)
RETURN RAW
IS
    hash RAW(32);
BEGIN
    hash := dbms_crypto.hash(f_password, dbms_crypto.hash_sh256);
    RETURN hash;
END;
--/

--/
CREATE OR REPLACE FUNCTION compare_passwords
(
    user_id in USERS.id%TYPE,
    password in CLOB
)
RETURN NUMBER
IS
    hash RAW(32);
    user_password RAW(32);
BEGIN
    SELECT password INTO user_password FROM USERS WHERE id = user_id;

    hash := dbms_crypto.hash(password, dbms_crypto.hash_sh256);
    RETURN DBMS_LOB.compare(hash, user_password);
END;
--/

