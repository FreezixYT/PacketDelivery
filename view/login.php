<div class="flex flex-col bg-color-red items-center min-h-screen">
    <h1 class="text-xl mt-40 mb-5">Connection</h1>
    <form method="post" action="/login" class="fieldset bg-base-100 border-base-300 rounded-box w-xs border p-4">
        <fieldset class="fieldset">
            <label class="label">Email</label>
            <label class="input validator">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </g>
                </svg>
                <input type="text" name="email" required placeholder="Email" />
            </label>
        </fieldset>
        <label class="fieldset">
            <span class="label">Password</span>
            <label class="input validator">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                        <path
                            d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path>
                        <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                    </g>
                </svg>
                <input type="password" name="password" required placeholder="Password" />
            </label>
        </label>
        <span id="error" class="validator-hint hidden">Required</span>
        <?php if (!empty($errors)) : ?>
                <ul style="color:red;">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <button class="btn btn-neutral mt-4" type="submit">Login</button>
    </form>
</div>