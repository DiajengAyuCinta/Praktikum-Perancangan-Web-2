import cv2

# 1. Load Haar Cascade untuk wajah dan senyum
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")
smile_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_smile.xml")

# 2. Buka kamera laptop
cam = cv2.VideoCapture(0, cv2.CAP_DSHOW)  # CAP_DSHOW bantu kamera Windows

if not cam.isOpened():
    print("Kamera tidak bisa dibuka!")
    exit()

print("✅ Kamera berhasil dibuka. Tekan Q untuk keluar.")

# 3. Loop untuk membaca frame
while True:
    ret, frame = cam.read()
    if not ret:
        print("Gagal membaca frame kamera!")
        break

    # 4. Ubah ke grayscale
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # 5. Deteksi wajah
    faces = face_cascade.detectMultiScale(gray, 1.3, 5)

    # 6. Untuk setiap wajah
    for (x, y, w, h) in faces:
        # Gambar kotak wajah
        cv2.rectangle(frame, (x, y), (x+w, y+h), (255, 0, 0), 2)

        # Region of Interest (ROI)
        face_gray = gray[y:y+h, x:x+w]
        face_color = frame[y:y+h, x:x+w]

        # 7. Deteksi senyum pada ROI
        smiles = smile_cascade.detectMultiScale(face_gray, 1.7, 20)

        # 8. Jika ada senyum
        if len(smiles) > 0:
            cv2.putText(frame, "SENYUM :)", (x, y-10), 
                        cv2.FONT_HERSHEY_SIMPLEX, 1, (0,255,0), 2)
        else:
            cv2.putText(frame, "TIDAK SENYUM", (x, y-10), 
                        cv2.FONT_HERSHEY_SIMPLEX, 1, (0,0,255), 2)

    # 9. Tampilkan hasil
    cv2.imshow("Smile Detector - Tekan Q untuk keluar", frame)

    # 10. Tombol keluar
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# 11. Tutup kamera
cam.release()
cv2.destroyAllWindows()
