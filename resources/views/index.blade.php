@extends('layouts.main')

@section('title' , 'Personal')

@section('content')

<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200%">

                <div class="6u 12u$(medium)">

                    <ul class="actions small">
                        <li><a href="#" class="button special small">Logout</a></li>
                    </ul>

                    <h3>Profile</h3>

                    <form method="post" action="#">
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5>Name</h5>
                                <input type="text" name="name" id="name" value="" placeholder="Name" />
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Email</h5>
                                <input type="email" name="email" id="email" value="" placeholder="Email" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5>Password</h5>
                                <input type="password" name="password" id="password" value="" placeholder="Password" />
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Repeat Password</h5>
                                <input type="password" name="password_2" id="password_2" value="" placeholder="Repeat Password" />
                            </div>

                            <div class="12u$">
                                <h5>Gender</h5>
                                <div class="select-wrapper">
                                    <select name="category" id="category">
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="6u 12u$(small)">
                                <input type="checkbox" id="consent" name="consent">
                                <label for="consent">I agree to the processing of data</label>
                            </div>
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li><input type="submit" value="Save" /></li>
                                    <li><input type="reset" value="Reset" class="alt" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="6u$ 12u$(medium)">
                    <!-- Blockquote -->
                    <h3>Blockquote</h3>
                    <blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum
                        ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan
                        faucibus. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis.</blockquote>
                </div>
            </div>

        </div>

    </section>

</div>

@endsection