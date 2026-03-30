<?php
require_once 'config.php';

$experiences = $conn->query("SELECT * FROM experiences ORDER BY sort_order ASC");
$skills      = $conn->query("SELECT * FROM skills ORDER BY sort_order ASC");
$certs_org   = $conn->query("SELECT * FROM certificates WHERE category = 'Organisasi' ORDER BY sort_order ASC");
$certs_akad  = $conn->query("SELECT * FROM certificates WHERE category = 'Akademik'   ORDER BY sort_order ASC");

function blobToDataUri($blobData) {
    if (empty($blobData)) return null;
    return 'data:image/jpeg;base64,' . base64_encode($blobData);
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portofolio - Yudha Tri Atmaja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">YTAPorto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Me</a></li>
                    <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HOME -->
    <section id="home">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <p class="greeting">Hai, saya</p>
                    <h1>Yudha Tri Atmaja</h1>
                    <p class="desc">Mahasiswa Sistem Informasi Fakultas Teknik Universitas Mulawarman Angkatan 2024.</p>
                    <div class="mt-4">
                        <a href="#about"        class="btn btn-primary-custom me-3">Tentang Saya</a>
                        <a href="#certificates" class="btn btn-outline-custom">Lihat Sertifikat</a>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="photo-box">
                        <img src="yuda.jpeg" alt="Yudha Tri Atmaja" class="photo-img">
                        <div id="photo-placeholder" class="photo-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="title-underline"></div>

            <div class="row g-5 mt-2">

                <div class="col-lg-6">
                    <p class="about-text">Saya adalah mahasiswa sistem informasi fakultas teknik universitas mulawarman angkatan 2024, yang memiliki ketertarikan di bidang pengembangan web dan database. Saya terbiasa bekerja dengan HTML, CSS, dan Java Script, serta memahami cara membangun dan mengelola sistem menggunakan MySQL.</p>
                    <p class="about-text">Di luar akademik, saya aktif berorganisasi di Information System Association (INFORSA) dan saat ini dipercaya sebagai Kepala Departemen Professional Skill Development - sebuah peran yang mendorong saya untuk terus tumbuh sekaligus berkontribusi nyata dalam pengembangan kemampuan rekan-rekan di organisasi.</p>
                </div>

                <!-- Experience -->
                <div class="col-lg-6">
                    <h5 class="sub-title mb-3">Experience</h5>
                    <?php while ($exp = $experiences->fetch_assoc()): ?>
                    <div class="exp-item">
                        <span class="exp-year"><?= htmlspecialchars($exp['year_range']) ?></span>
                        <div>
                            <div class="exp-role"><?= htmlspecialchars($exp['role']) ?></div>
                            <div class="exp-place"><?= htmlspecialchars($exp['place']) ?></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Skills -->
            <div class="skills-block mt-5">
                <h5 class="sub-title mb-4">Skills</h5>
                <div class="row g-4">
                    <?php while ($skill = $skills->fetch_assoc()): ?>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                            <span class="skill-val"><?= (int)$skill['percentage'] ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar"
                                style="width: <?= (int)$skill['percentage'] ?>%; background: #3b82f6;">
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </section>

    <!-- CERTIFICATES -->
    <section id="certificates">
        <div class="container">
            <h2 class="section-title">Certificates</h2>
            <div class="title-underline"></div>

            <!-- Organisasi -->
            <h5 class="cert-sub-title mt-4 mb-3">🏛️ Organisasi</h5>
            <div class="row g-4">
                <?php while ($cert = $certs_org->fetch_assoc()):
                    $imgSrc = blobToDataUri($cert['photo']);
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="cert-card">
                        <div class="cert-photo-wrap" style="min-height: 200px;">
                            <?php if ($imgSrc): ?>
                                <img src="<?= $imgSrc ?>"
                                    alt="<?= htmlspecialchars($cert['title']) ?>"
                                    class="cert-photo">
                            <?php else: ?>
                                <div class="cert-photo-placeholder">
                                    <span>🖼️</span>
                                    <span>Foto belum diupload</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="cert-info">
                            <div class="cert-tag"><?= htmlspecialchars($cert['tag']) ?></div>
                            <h5 class="cert-title"><?= htmlspecialchars($cert['title']) ?></h5>
                            <p class="cert-meta">
                                <?= htmlspecialchars($cert['issuer']) ?> · <?= htmlspecialchars($cert['year']) ?>
                            </p>
                            <p class="cert-desc"><?= nl2br(htmlspecialchars($cert['description'])) ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <!-- Akademik -->
            <h5 class="cert-sub-title mt-5 mb-3">🎓 Akademik</h5>
            <div class="row g-4">
                <?php while ($cert = $certs_akad->fetch_assoc()):
                    $imgSrc = blobToDataUri($cert['photo']);
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="cert-card">
                        <div class="cert-photo-wrap" style="min-height: 200px;">
                            <?php if ($imgSrc): ?>
                                <img src="<?= $imgSrc ?>"
                                    alt="<?= htmlspecialchars($cert['title']) ?>"
                                    class="cert-photo">
                            <?php else: ?>
                                <div class="cert-photo-placeholder">
                                    <span>🖼️</span>
                                    <span>Foto belum diupload</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="cert-info">
                            <div class="cert-tag"><?= htmlspecialchars($cert['tag']) ?></div>
                            <h5 class="cert-title"><?= htmlspecialchars($cert['title']) ?></h5>
                            <p class="cert-meta">
                                <?= htmlspecialchars($cert['issuer']) ?> · <?= htmlspecialchars($cert['year']) ?>
                            </p>
                            <p class="cert-desc"><?= nl2br(htmlspecialchars($cert['description'])) ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

        </div>
    </section>

    <footer>
        <p>© 2026 Yudha Tri Atmaja · Sistem Informasi Universitas Mulawarman</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>