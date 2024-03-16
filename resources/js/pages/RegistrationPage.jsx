import React, { useState } from "react";
import * as Yup from "yup";
import "./RegistrationPage.css";
import { IoMdClose, IoMdArrowRoundBack } from "react-icons/io";
import { Toast } from "../lib/sweetalert";
import axios from "axios";

const BASE_URL = import.meta.env.VITE_BASE_URL;
// const baseURL = process.env.VITE_APP_URL;

function RegistrationPage() {
    const [step, setStep] = useState(1);
    const [data, setData] = useState({
        email: "",
        password: "",
        password_confirmation: "",
        firstname: "",
        lastname: "",
        address: "",
        profile_picture: null,
    });

    const [errors, setErrors] = useState();
    const [emptyMsg, setEmptyMsg] = useState();

    // Yup Validation Schema
    const validationSchema = Yup.object({
        email: Yup.string()
            .required("Email is required")
            .email("Invalid email format"),
        password: Yup.string()
            .required("Password is required")
            .min(8, "Password must be at least 8 characters"),
        password_confirmation: Yup.string()
            .oneOf([Yup.ref("password")], "Password must match")
            .required("Confirm password is required"),
        firstname: Yup.string().required("First Name is required"),
        lastname: Yup.string().required("Last Name is required"),
        address: Yup.string().required("Address is required"),
        profile_picture: Yup.mixed()
            .required("Please select an image file")
            .test("fileType", "Invalid file format", (value) => {
                return value && value.type.startsWith("image/");
            }),
    });

    // Validation for next page
    const handleNext = (e) => {
        e.preventDefault();

        if (!data.email || !data.password || !data.password_confirmation) {
            setEmptyMsg("Please fill all fields");
            setTimeout(() => {
                setEmptyMsg(null);
            }, 5000);
        } else if (data.password !== data.password_confirmation) {
            setEmptyMsg("Confirm Password does not match in password");
            setTimeout(() => {
                setEmptyMsg(null);
            }, 5000);
        } else {
            setStep(2);
        }
    };

    // Back button
    const handlePrev = (e) => {
        e.preventDefault();
        setStep(1);
    };

    // Register functionality
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await validationSchema.validate(data, { abortEarly: false });

            // FORM DATA
            const formData = new FormData();
            formData.append("email", data.email);
            formData.append("password", data.password);
            formData.append(
                "password_confirmation",
                data.password_confirmation
            );
            formData.append("firstname", data.firstname);
            formData.append("lastname", data.lastname);
            formData.append("address", data.address);
            formData.append("profile_picture", data.profile_picture);

            // Sends data in Database
            const response = await axios.post(
                `${BASE_URL}/api/auth/register`,
                formData,
                { headers: { "Content-Type": "multipart/form-data" } }
            );
            if (response.data.success) {
                Toast.fire({
                    icon: "success",
                    title: "User registration successful.",
                });
                setData({
                    email: "",
                    password: "",
                    password_confirmation: "",
                    firstname: "",
                    lastname: "",
                    address: "",
                    profile_picture: null,
                });
            }
        } catch (error) {
            const newErrors = {};

            error.inner.forEach((err) => {
                newErrors[err.path] = err.message;
            });

            setErrors(newErrors);
            setTimeout(() => {
                setErrors(null);
            }, 5000);
            Toast.fire({
                icon: "error",
                title: "Error! Try again.",
            });
        }
    };

    // Handles on change for text field
    const handleOnChange = (e) => {
        const { name, value } = e.target;
        setData({
            ...data,
            [name]: value,
        });
    };

    // Handles on change for image
    const handleImageChange = (e) => {
        const file = e.target.files[0];
        setData({
            ...data,
            profile_picture: file,
        });
    };

    return (
        <div className="registration">
            <div className="registration__header">
                <h1 className="header__name">RMS</h1>
                {step === 2 ? (
                    <button onClick={handlePrev} className="header__button">
                        <IoMdArrowRoundBack style={{ height: 30, width: 30 }} />
                    </button>
                ) : null}
            </div>
            <form className="registration__form">
                <h1 className="form__title">Register</h1>
                <p className="error__message">{emptyMsg}</p>
                {step === 1 ? (
                    <>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">Email</h1>
                                <h1 className="error__label">
                                    {errors?.email ? `- ${errors.email}` : null}
                                </h1>
                            </div>
                            <input
                                type="text"
                                name="email"
                                placeholder="Email"
                                value={data.email}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">Password</h1>
                                <h1 className="error__label">
                                    {errors?.password
                                        ? `- ${errors.password}`
                                        : null}
                                </h1>
                            </div>
                            <input
                                type="password"
                                name="password"
                                placeholder="Password"
                                value={data.password}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">Confirm Password</h1>
                                <h1 className="error__label">
                                    {errors?.password_confirmation
                                        ? `- ${errors.password_confirmation}`
                                        : null}
                                </h1>
                            </div>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm Password"
                                value={data.password_confirmation}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                    </>
                ) : (
                    <>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">First Name</h1>
                                <h1 className="error__label">
                                    {errors?.firstname
                                        ? `- ${errors.firstname}`
                                        : null}
                                </h1>
                            </div>
                            <input
                                type="text"
                                name="firstname"
                                placeholder="First Name"
                                value={data.firstname}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">Last Name</h1>
                                <h1 className="error__label">
                                    {errors?.lastname
                                        ? `- ${errors.lastname}`
                                        : null}
                                </h1>
                            </div>
                            <input
                                type="text"
                                name="lastname"
                                placeholder="Last Name"
                                value={data.lastname}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                        <div className="input__container">
                            <div className="error__container">
                                <h1 className="label">Address</h1>
                                <h1 className="error__label">
                                    {errors?.address
                                        ? `- ${errors.address}`
                                        : null}
                                </h1>
                            </div>
                            <input
                                type="text"
                                name="address"
                                placeholder="Address"
                                value={data.address}
                                onChange={handleOnChange}
                                className="registration__input"
                            />
                        </div>
                        <div className="input__container">
                            <h1 className="label">Profile Picture</h1>
                            <input
                                name="profile_picture"
                                type="file"
                                accept="image/*"
                                onChange={handleImageChange}
                            />
                        </div>
                    </>
                )}
                {step === 1 ? (
                    <button onClick={handleNext} className="form__submit">
                        NEXT
                    </button>
                ) : (
                    <button
                        type="submit"
                        className="form__submit"
                        onClick={handleSubmit}
                    >
                        Confirm
                    </button>
                )}
            </form>
        </div>
    );
}

export default RegistrationPage;
